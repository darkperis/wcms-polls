<?php

namespace Darkpony\WCMSPolls\Helpers;

use Darkpony\WCMSPolls\Guest;
use Darkpony\WCMSPolls\Poll;
use Darkpony\WCMSPolls\Traits\PollWriterResults;
use Darkpony\WCMSPolls\Traits\PollWriterVoting;

class PollWriter
{
    use PollWriterResults,
        PollWriterVoting;

    /**
     * Draw a Poll
     *
     * @param Poll $poll
     * @return string
     */
    public function draw($poll)
    {
        if(is_int($poll)){
            $poll = Poll::findOrFail($poll);
        }

        if(!$poll instanceof Poll){
            throw new \InvalidArgumentException("The argument must be an integer or an instance of Poll");
        }

        if ($poll->isComingSoon()) {
            return 'Θα ξεκινήσει σε λίγο'; //To start soon
        }

        $voter = $poll->canGuestVote() ? new Guest(request()) : auth(config('wcmspolls_config.admin_guard'))->user();

        if (is_null($voter) || $voter->hasVoted($poll->id) || $poll->isLocked() || $poll->hasEnded()) {
            if (!$poll->showResultsEnabled()) {
                return 'Ευχαριστούμε για την ψήφο σας'; //Thanks for voting
            }
            return $this->drawResult($poll);
        }
        if ($poll->isRadio()) {
            return $this->drawRadio($poll);
        }
        return $this->drawCheckbox($poll);
    }
}
