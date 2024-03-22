<?php

namespace Darkpony\WCMSPolls;


use Darkpony\WCMSPolls\Traits\Voter;
use Illuminate\Http\Request;


class Guest
{
    use Voter;

    public $user_id;

    public function __construct(Request $request)
    {
        $this->user_id = session()->getId();
        // md5($request->ip() . $request->header('User-Agent'));
        //$this->getClientIPAddress($request)
    }

    protected function getAnonUserId(Request $request)
    {
        return md5($request->ip() . $request->header('User-Agent'));
    }

    private function getClientIPAddress($request)
    {
        //For Cloudflare
        if (!empty($request->server('HTTP_CF_CONNECTING_IP')))
        {
            $ipAddress = $request->server('HTTP_CF_CONNECTING_IP');
        }
        //For share internet IP
        elseif (!empty($request->server('HTTP_CLIENT_IP')))
        {
            $ipAddress = $request->server('HTTP_CLIENT_IP');
        }
        //For Google App Engine and other proxy
        elseif (!empty($request->server('HTTP_X_FORWARDED_FOR')))
        {
            $temp      = $request->server('HTTP_X_FORWARDED_FOR');
            $ipAddress = trim(explode(',', $temp)[0]);
        }
        else
        {
            $ipAddress = $request->ip();
        }
        return $ipAddress;
    }
}
