<?php

namespace App\Http\Controllers\Central\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Api\Auth\UpdateProfileRequest;
use App\Models\User;
use App\Classes\ApiResponseClass;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Group;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\Authenticated;


#[Group("1-Authentication Service", "APIs for managing authentification")]
class ProfileController extends Controller
{
    /**
     * Get profile
     */
    #[Authenticated]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function show()
    {
        try {
            $user = Auth::user();
            return ApiResponseClass::sendResponse($user->toArray(), JsonResponse::HTTP_OK, 'User prodfile data');
        } catch (TokenInvalidException $e) {
            return ApiResponseClass::rollback($e);
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Update profile
     */
    #[Authenticated]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function update(UpdateProfileRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::find(Auth::user()->id);
            $user->update($validated);
            return ApiResponseClass::sendResponse($user->toArray(), JsonResponse::HTTP_OK, 'Profile updated successfully');
        } catch (TokenInvalidException $e) {
            return ApiResponseClass::rollback($e);
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
