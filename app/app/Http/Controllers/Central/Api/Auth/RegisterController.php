<?php

namespace App\Http\Controllers\Central\Api\Auth;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Api\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\Unauthenticated;

#[Group("1-Authentication Service", "APIs for managing authentification")]
class RegisterController extends Controller
{
    /**
     * Register user
     */
    #[Unauthenticated]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());
            if (!$user) {
                return ApiResponseClass::sendError('Internal server error', ['Failed to create user.'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
            return ApiResponseClass::sendResponse($user->toArray(), JsonResponse::HTTP_OK, 'User registered successfully');
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
