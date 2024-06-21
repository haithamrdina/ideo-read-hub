<?php

namespace App\Http\Integrations\Youscribe\Auth;

use App\Http\Integrations\Youscribe\Requests\YouscribeAccess;
use App\Http\Integrations\Youscribe\YouscribeConnector;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class YouscribeAuth implements Authenticator
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
        if ($pendingRequest->getRequest() instanceof YouscribeAccess) {
            return;
        }
        $ysConnector = new YouscribeConnector('https://services.youscribe.com/api');
        $response = $ysConnector->send(new YouscribeAccess);
        $pendingRequest->headers()->add('ys-auth', str_replace('"', '', $response->body()));
    }
}
