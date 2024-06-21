<?php

namespace App\Http\Integrations\Youscribe\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class YouscribeAuthorizeUser extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    protected string $userLogin;
    public function __construct(string $userLogin)
    {
        $this->userLogin = $userLogin;
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/authorizeuser';
    }

    protected function defaultBody(): array
    {
        return [
            'UserLogin' => $this->userLogin,
            'ValidityInHours' => 23,
        ];
    }
}
