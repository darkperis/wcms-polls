<?php

namespace Darkpony\WCMSPolls;

use Illuminate\Database\Eloquent\Model;
use Darkpony\WCMSPolls\Traits\PollCreator;
use Darkpony\WCMSPolls\Traits\PollAccessor;
use Darkpony\WCMSPolls\Traits\PollManipulator;
use Darkpony\WCMSPolls\Traits\PollQueries;
use Carbon\Carbon;

class Poll extends Model
{
    use PollCreator, PollAccessor, PollManipulator, PollQueries;

    protected $fillable = ['question', 'canVisitorsVote', 'canVoterSeeResult'];

    protected $table = 'polls';

    protected $guarded = [''];

    /**
     * A poll has many options related to
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    /**
     * Boot Method
     *
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($poll) {
            $poll->options->each(function ($option) {
                Vote::where('poll_option_id', $option->id)->delete();
            });
            $poll->options()->delete();
        });
    }

    /**
     * Get all of the votes for the poll.
     */
    public function votes()
    {
        return $this->hasManyThrough(Vote::class, PollOption::class);
    }

    /**
     * Check if the Guest has the right to vote
     *
     * @return bool
     */
    public function canGuestVote()
    {
        return $this->canVisitorsVote === 1;
    }

    /**
     * Check if the user can change options
     *
     * @return bool
     */
    public function canChangeOptions()
    {
        return $this->votes()->count() === 0;
    }

    /*public function scopeNotEnded($query)
    {
        return $query->whereNull('ends_at')->whereNull('isClosed')->orWhere('ends_at', '>', Carbon::now());
    }*/
}
