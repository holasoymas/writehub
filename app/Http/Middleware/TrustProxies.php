<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = '*'; // Trust all proxies (like Heroku)

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
    //  */
    // protected $headers =
    // Request::HEADER_X_FORWARDED_FOR
    //     | Request::HEADER_X_FORWARDED_HOST
    //     | Request::HEADER_X_FORWARDED_PROTO
    //     | Request::HEADER_X_FORWARDED_PORT;

    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
}
