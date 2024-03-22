<?php
namespace Darkpony\WCMSPolls\Traits;

use Illuminate\Support\Facades\Session;
use Darkpony\WCMSPolls\Poll;

trait PollWriterVoting
{
    /**
     * Drawing the poll for checkbox case
     *
     * @param Poll $poll
     */
    public function drawCheckbox(Poll $poll)
    {
        $options = $poll->options->pluck('name', 'id');

        echo view(config('wcmspolls_config.checkbox') ? config('wcmspolls_config.checkbox') :  'wcmspolls::stubs.checkbox', [
            'id' => $poll->id,
            'question' => $poll->question,
            'options' => $options,
            'ajax' => config('wcmspolls_config.ajax_form')
        ]);
    }

    /**
     * Drawing the poll for the radio case
     *
     * @param Poll $poll
     */
    public function drawRadio(Poll $poll)
    {
        $options = $poll->options->pluck('name', 'id');

        echo view(config('wcmspolls_config.radio') ? config('wcmspolls_config.radio') :'wcmspolls::stubs.radio', [
            'id' => $poll->id,
            'question' => $poll->question,
            'options' => $options,
            'ajax' => config('wcmspolls_config.ajax_form')
        ]);
    }
}
