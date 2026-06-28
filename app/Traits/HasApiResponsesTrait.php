<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * HasApiResponsesTrait
 *
 * @author    Muhammad Sumon Molla Selim <sumonmselim@gmail.com>
 * @copyright Copyright (c) 2021 Kodeeo <https://kodeeo.com>
 * @package   App\Traits
 */
trait HasApiResponsesTrait
{
    /**
     * @param  string  $message
     * @param  int  $statusCode
     *
     * @return JsonResponse
     */
    protected function respondWithSuccess(string $message,  $data=null, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * @param  string  $message
     * @param  array  $data
     * @param  int  $statusCode
     *
     * @return JsonResponse
     */
    protected function respondWithError(string $message, array $data = [], int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $data,
        ], $statusCode);
    }

    /**
     * @param  JsonResource  $jsonResource
     *
     * @return mixed
     */
    protected function responseForCollection(JsonResource $jsonResource): mixed
    {
        return $jsonResource->response()->getData(true)['data'];
    }


}
