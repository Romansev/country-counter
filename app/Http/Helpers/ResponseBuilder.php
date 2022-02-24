<?php


namespace App\Http\Helpers;


use Illuminate\Http\JsonResponse;

class ResponseBuilder
{
    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public static function success($data, int $status = 200): JsonResponse
    {
        $result = [
            'httpStatus' => $status,
            'data'       => $data,
        ];

        return new JsonResponse($result, $status);
    }

    /**
     * @param string|null $message
     * @param int $status
     * @return JsonResponse
     */
    public static function error(?string $message = '', int $status = 400): JsonResponse
    {
        $result = [
            'error' => [
                'code'    => $status,
                'message' => $message,
            ]
        ];

        return new JsonResponse($result, 200);
    }
}
