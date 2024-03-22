<?php
namespace Darkpony\WCMSPolls;

use Illuminate\Support\Facades\Facade;
use Darkpony\WCMSPolls\Helpers\PollWriter;

class PollWriterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PollWriter::class;
    }
}
