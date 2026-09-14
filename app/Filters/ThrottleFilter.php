<?php

declare(strict_types=1);

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Limits the number of requests per client IP and path within one minute.
 *
 * Usage in routes or filter config: `throttle` (60 requests per minute)
 * or `throttle:5` for a custom limit, e.g. on the login endpoint.
 */
class ThrottleFilter implements FilterInterface
{
    private const DEFAULT_LIMIT = 60;

    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $request instanceof IncomingRequest) {
            return;
        }

        $limit = isset($arguments[0]) ? max(1, (int) $arguments[0]) : self::DEFAULT_LIMIT;
        $key   = 'throttle_' . md5(implode('|', [
            $request->getIPAddress(),
            $request->getUri()->getPath(),
            $limit,
        ]));

        if (service('throttler')->check($key, $limit, MINUTE) === false) {
            return service('response')
                ->setStatusCode(429)
                ->setBody('Too many requests. Please try again in a minute.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
