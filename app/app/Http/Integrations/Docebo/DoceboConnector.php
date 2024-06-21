<?php

namespace App\Http\Integrations\Docebo;

use App\Http\Integrations\Docebo\Auth\DoceboAuth;
use App\Models\Tenant;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\Traits\Plugins\AcceptsJson;

class DoceboConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    protected Tenant $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }
    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->tenant->endpoint;
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

    /**
     * Default HTTP client authentication
     */
    protected function defaultAuth(): ?Authenticator
    {
        return new DoceboAuth($this->tenant);
    }

    public function paginate(Request $request): Paginator
    {
        return new class ($this, $request) extends Paginator {
            protected ?int $perPageLimit = 200;
            protected function isLastPage(Response $response): bool
            {
                return !$response->json('data')['has_more_data'];
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('data');
            }

            protected function getTotalPages(Response $response): int
            {
                return $response->json('data')['total_page_count'];
            }

            protected function applyPagination(Request $request): Request
            {
                $request->query()->add('page', $this->page);
                $request->query()->add('page_size', $this->perPageLimit);

                return $request;
            }
        };
    }

}
