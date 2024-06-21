<?php

namespace App\Http\Integrations\Forma\Auth;

use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class FormaAuth implements Authenticator
{
    public function __construct()
    {
        //
    }

    /**
     * Apply the authentication to the request.
     */
    public function set(PendingRequest $pendingRequest): void
    {
        //
    }
}
