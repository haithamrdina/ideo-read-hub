<?php

namespace App\Http\Integrations\Docebo\Auth;

use App\Http\Integrations\Docebo\Requests\DoceboAccess;
use App\Models\Tenant;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class DoceboAuth implements Authenticator
{
    protected Tenant $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Apply the authentication to the request.
     */
    public function set(PendingRequest $pendingRequest): void
    {
        if ($pendingRequest->getRequest() instanceof DoceboAccess) {
            return;
        }
        $response = $pendingRequest->getConnector()->send(new DoceboAccess($this->tenant));
        $pendingRequest->headers()->add('Authorization', 'Bearer ' . $response->json('data')["access_token"]);
    }
}
