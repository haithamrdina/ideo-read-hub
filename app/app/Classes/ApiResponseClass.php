<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function rollback($e, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message = "Something went wrong! Process not completed")
    {
        Log::error($e);
        $response['name'] = 'Internal server error';
        $response['message'] = [$e->getMessage()];
        $response['status'] = 500;
        throw new HttpResponseException(response()->json($response, 500));
    }

    public static function sendResponse($result, $code = 200, $message = null, $meta = null, $version = null)
    {

        $response['success'] = $code >= 200 && $code < 300;
        if (!empty($message)) {
            Log::info($message);
            $response['message'] = $message;
        }
        $response['data'] = (!empty($result)) ? $result : [];
        $response['verison'] = (!empty($version)) ? $version : '1.0.0';
        if (!empty($meta)) {
            $response = array_merge($response, $meta);
        }
        $response['status'] = $code;
        return response()->json($response, $code);
    }

    public static function sendError($name, $message, $code = 500)
    {
        Log::error($message);
        $response['success'] = $code >= 200 && $code < 300;
        $response['name'] = $name;
        $response['message'] = $message;
        $response['status'] = $code;
        return response()->json($response, $code);
    }

    public static function sendSuccess($message, $code = 200)
    {
        Log::info($message);
        $response['success'] = $code >= 200 && $code < 300;
        $response['message'] = $message;
        $response['status'] = $code;
        return response()->json($response, $code);
    }


    public static function sendResponseCollection($result, $code = 200, $message = null, $meta = null, $version = null, $extra_data = null, $links = null)
    {

        $response['success'] = $code >= 200 && $code < 300;
        if (!empty($message)) {
            Log::info($message);
            $response['message'] = $message;
        }
        $response['data'] = [
            'items' => (!empty($result)) ? $result : []
        ];
        if (!empty($meta)) {
            $response['data']['count'] = $meta['count'];
            $response['data']['has_more_data'] = $meta['has_more_data'];
            $response['data']['current_page'] = $meta['current_page'];
            $response['data']['current_page_size'] = $meta['current_page_size'];
            $response['data']['total_page_count'] = $meta['total_page_count'];
            $response['data']['total_count'] = $meta['total_count'];
        }
        $response['verison'] = (!empty($version)) ? $version : '1.0.0';
        if (!empty($extra_data)) {
            $response['extra_data'] = $extra_data;
        }
        $response['_links'] = (!empty($links)) ? $links : [];
        return response()->json($response, $code);
    }
}
