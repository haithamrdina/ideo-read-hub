<?php

namespace App\Http\Integrations\Youscribe\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class YouscribeAccess extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/authorize';
    }

    protected function defaultBody(): array
    {
        return [
            'UserName' => 'ideolearning',
            'Password' => '#E^5p4(8uGwK',
            'ValidityInHours' => 23,
        ];
    }
}
