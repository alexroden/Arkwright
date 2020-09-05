<?php

namespace App\Http\Middleware\Traits;

use Symfony\Component\HttpFoundation\Response;

trait Unauthorised
{
    /**
     * Common method for returning an unauthorized error.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function handleError(): Response
    {
        return response()->json([
            'message'     => 'You are not authorized to view this content.',
            'status_code' => 401,
        ], 401);
    }
}
