<?php

namespace Darkpony\WCMSPolls;

use Illuminate\Database\Eloquent\Model;
use Darkpony\WCMSPolls\Traits\Votable;

class PollOption extends Model
{
    use Votable;

    protected $guarded = [];

    protected $table = 'poll_options';
    /**
     * An option belongs to one poll
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    /**
     * Check if the option is Closed
     *
     * @return bool
     */
    public function isPollClosed()
    {
        return $this->poll->isLocked();
    }
}
