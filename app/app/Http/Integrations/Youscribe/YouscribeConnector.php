<?php

namespace App\Http\Integrations\Youscribe;

use App\Http\Integrations\Youscribe\Auth\YouscribeAuth;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

class YouscribeConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    public function __construct(protected readonly string $baseUrl)
    {
    }

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'content-type' => 'application/json'
        ];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [
            'timeout' => 60,
        ];
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new YouscribeAuth();
    }

    public function paginate(Request $request): OffsetPaginator
    {
        return new class ($this, $request) extends OffsetPaginator {
            protected ?int $perPageLimit = 1000;

            protected function isLastPage(Response $response): bool
            {
                return $this->getOffset() >= (int) $response->json('TotalResults');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('Products');
            }

            protected function applyPagination(Request $request): Request
            {
                $request->query()->merge([
                    'take' => $this->perPageLimit,
                    'skip' => $this->getOffset(),
                ]);

                return $request;
            }
        };
    }
}
