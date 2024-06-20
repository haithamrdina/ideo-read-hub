<?php

use App\Classes\ApiResponseClass;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Psy\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {

            /** master routing @s */
            Route::prefix('master')
                ->middleware('api')
                ->domain('localhost')
                ->name('master.v1.')
                ->group(base_path('routes/master/api.php'));

            Route::middleware('web')
                ->domain('localhost')
                ->group(base_path('routes/master/web.php'));
            /** master routing @e */

            /** tenancy routing @s */
            $centralDomains = config('tenancy.central_domains');

            foreach ($centralDomains as $domain) {
                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/tenant/web.php'));
            }
            Route::middleware('web')->group(base_path('routes/tenant/web.php'));

            foreach ($centralDomains as $domain) {
                Route::prefix('api')
                    ->middleware('api')
                    ->domain($domain)
                    ->group(base_path('routes/tenant/api.php'));
            }
            Route::middleware('api')->group(base_path('routes/tenant/api.php'));
            /** tenancy routing @e */
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'central_api_key' => \App\Http\Middleware\CentralApiKey::class,
            'tenant_api_key' => \App\Http\Middleware\TenantApiKey::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (AuthenticationException $e) {
            return ApiResponseClass::sendError('Unauthorized', [$e->getMessage()], JsonResponse::HTTP_UNAUTHORIZED);
        });
        $exceptions->renderable(function (AuthorizationException $e) {
            return ApiResponseClass::sendError('Forbidden', [$e->getMessage()], JsonResponse::HTTP_FORBIDDEN);
        });
        $exceptions->renderable(function (HttpException $e) {
            return ApiResponseClass::sendError('Forbidden', [$e->getMessage()], JsonResponse::HTTP_FORBIDDEN);
        });
        $exceptions->renderable(function (MethodNotAllowedHttpException $e) {
            return ApiResponseClass::sendError('Method Not Allowed', [$e->getMessage()], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        });
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return ApiResponseClass::sendError('Not Found', [$e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        });
        $exceptions->renderable(function (FatalErrorException $e) {
            return ApiResponseClass::sendError('Internal server error', [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        });
        $exceptions->renderable(function (ModelNotFoundException $e) {
            return ApiResponseClass::sendError('Data Not Found', [$e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        });
        $exceptions->renderable(function (AccessDeniedHttpException $e) {
            return ApiResponseClass::sendError('Forbidden', [$e->getMessage()], JsonResponse::HTTP_FORBIDDEN);
        });
        $exceptions->renderable(function (BindingResolutionException $e) {
            return ApiResponseClass::sendError('Internal server error', [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        });

        $exceptions->renderable(function (QueryException $e) {
            return ApiResponseClass::sendError('Internal server error', [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        });
        $exceptions->renderable(function (InvalidArgumentException $e) {
            return ApiResponseClass::sendError('General error', [$e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        });
        $exceptions->renderable(function (ThrottleRequestsException $e) {
            return ApiResponseClass::sendError('Too Many Attempts', [$e->getMessage()], 429);
        });
    })->create();
