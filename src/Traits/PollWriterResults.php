<?php
namespace Darkpony\WCMSPolls\Traits;


use Darkpony\WCMSPolls\Poll;

trait PollWriterResults
{
    /**
     * Draw the results of voting
     *
     * @param Poll $poll
     */
    public function drawResult(Poll $poll)
    {
        $total = $poll->votes->count();
        $results = $poll->results()->grab();
        $options = collect($results)->map(function ($result) use ($total){
                return (object) [
                    'votes' => $result['votes'],
                    'percent' => $total === 0 ? 0 : ($result['votes'] / $total) * 100,
                    'name' => $result['option']->name
                ];
        });
        $question = $poll->question;
        echo view(config('wcmspolls_config.results') ? config('wcmspolls_config.results') : 'wcmspolls::stubs.results', compact('options', 'question'));
    }
}
