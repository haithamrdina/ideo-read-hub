<?php

namespace App\Http\Integrations\Youscribe\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class YouscribeCreateSubscriber extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    protected string $userId;
    protected string $userLogin;
    protected string $userEmail;
    protected string $userFirstName;
    protected string $userLastName;
    public function __construct(string $userId, string $userLogin, string $userEmail, string $userFirstName, string $userLastName)
    {
        $this->userId = $userId;
        $this->userLogin = $userLogin;
        $this->userEmail = $userEmail;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
    }
    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/create';
    }

    protected function defaultBody(): array
    {
        return [
            'UserId' => $this->userId,
            'OfferTypeId' => 11,
            'UserLogin' => $this->userLogin,
            'UserEmail' => $this->userEmail,
            'UserFirstName' => $this->userFirstName,
            'UserLastName' => $this->userLastName,
            'AllowYouScribeToUpdateLogin' => false
        ];
    }
}
