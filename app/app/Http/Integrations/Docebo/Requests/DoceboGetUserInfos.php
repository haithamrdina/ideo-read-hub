<?php

namespace App\Http\Integrations\Docebo\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class DoceboGetUserInfos extends Request
{
    protected Method $method = Method::GET;
    protected string $user_id;
    public function __construct(string $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/manage/v1/user/' . $this->user_id;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $item = $response->json('data')['user_data'];
        $filteredItems = [
            'user_id' => $item['user_id'],
            'youscribe_id' => 'docebo_' . $item['user_id'],
            'username' => $item['username'],
            'email' => $item['email'],
            'first_name' => $item['first_name'],
            'last_name' => $item['last_name'],
        ];
        return $filteredItems;
    }
}
