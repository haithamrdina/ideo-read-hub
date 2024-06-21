<?php

namespace App\Http\Integrations\Docebo\Requests;

use App\Models\Tenant;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class DoceboAccess extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;


    protected Tenant $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/manage/v1/user/login';
    }

    protected function defaultBody(): array
    {

        return [
            'username' => $this->tenant->username,
            'password' => $this->tenant->password,
            'issue_refresh_token' => true
        ];
    }
}
