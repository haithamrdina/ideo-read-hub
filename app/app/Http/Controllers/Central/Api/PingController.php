<?php

namespace App\Http\Controllers\Central\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Carbon;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromFile;

#[Group("2-Ping Service", "APIs for testing api")]
class PingController extends Controller
{
    /**
     * Ping app test api
     */
    #[Authenticated()]
    #[Response(status: 200, description: "Operation successful")]
    #[ResponseFromFile(description: "General Error", status: 400, file: "responses/errors/400.json")]
    #[ResponseFromFile(description: "Permission denied", status: 401, file: "responses/errors/401.json")]
    #[ResponseFromFile(description: "Permission denied", status: 403, file: "responses/errors/403.json")]
    #[ResponseFromFile(description: "Data not found", status: 404, file: "responses/errors/404.json")]
    #[ResponseFromFile(description: "Internal server error", status: 500, file: "responses/errors/500.json")]

    public function pingApi()
    {
        try {
            return ApiResponseClass::sendResponse(
                [
                    "apiMessage" => 'ping successful',
                    "currentTime" => Carbon::now()->toDateTimeString(),
                ]
            );
        } catch (Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
