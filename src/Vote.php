<?php

namespace Darkpony\WCMSPolls;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'user_id', 'poll_option_id'
    ];
    protected $table = 'votes';

    public function option()
    {
        return $this->belongsTo(PollOption::class);
    }
}
