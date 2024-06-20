<?php

namespace App\Http\Controllers\Central\Api\Auth;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Api\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Unauthenticated;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


#[Group("1-Authentication Service", "APIs for managing authentification")]
class LoginController extends Controller
{
    /**
     * Login User
     */
    #[Unauthenticated]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function login(LoginRequest $request)
    {
        try {
            $loginData = $request->validated();
            $user = User::where('email', $loginData['username'])->first();
            if ($user) {
                $credentials = [
                    'email' => $loginData['username'],
                    'password' => $loginData['password']
                ];

                $token = Auth::guard('api')->attempt($credentials);
                if (!$token) {
                    return ApiResponseClass::sendError('Unauthorized', ['Your request was made with invalid credentials.'], JsonResponse::HTTP_UNAUTHORIZED);
                }
                return ApiResponseClass::sendResponse(
                    [
                        "access_token" => $token,
                        "expires_in" => Auth::guard('api')->factory()->getTTL() * 15,
                        "token_type" => "bearer",
                        "scope" => "api",
                        "user_id" => Auth::guard('api')->user()->id,
                    ]
                );
            } else {
                return ApiResponseClass::sendError('General Error', ['User Not found.'], JsonResponse::HTTP_BAD_REQUEST);
            }
        } catch (JWTException $e) {
            return ApiResponseClass::rollback($e);
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Refresh user token
     */
    #[Authenticated]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function refresh()
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return ApiResponseClass::sendResponse(
                [
                    "access_token" => $token,
                    "expires_in" => Auth::guard('api')->factory()->getTTL() * 15,
                    "token_type" => "bearer",
                    "scope" => "api",
                    "user_id" => Auth::guard('api')->user()->id,
                ]
            );
        } catch (TokenInvalidException $e) {
            return ApiResponseClass::rollback($e);
        } catch (JWTException $e) {
            return ApiResponseClass::rollback($e);
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Logout  User
     */
    #[Authenticated]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]
    public function logout()
    {
        try {
            Auth::guard('api')->logout();
            Session::flush();
            return ApiResponseClass::sendSuccess(
                [
                    "User successfully logged out"
                ]
            );
        } catch (TokenInvalidException $e) {
            return ApiResponseClass::rollback($e);
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
