<?php

namespace App\Http\Middleware;

use App\Exceptions\HttpException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * @param       $request
     * @param array $guards
     * @return void
     * @throws HttpException
     */
    protected function authenticate($request, array $guards)
    {
        logger()->info('START - ' . __METHOD__);

        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                logger()->info('Success! Authenticate.');
                logger()->info('END - ' . __METHOD__);
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    /**
     * @param       $request
     * @param array $guards
     * @return void
     * @throws HttpException
     */
    protected function unauthenticated($request, array $guards): void
    {
        throw new HttpException(
            'UNAUTHORIZED',
            401
        );
    }
}
