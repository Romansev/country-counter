<?php

namespace App\Http\Controllers;

use App\Exceptions\CountryNotFoundException;
use App\Exceptions\IncException;
use App\Http\Helpers\ResponseBuilder;
use App\Services\CounterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CounterController extends Controller
{
    private CounterService $counterService;

    public function __construct(CounterService $counterService)
    {
        $this->counterService = $counterService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function increment(Request $request)
    {
        try {
            $result = $this->counterService->increment($request->country);

        } catch (CountryNotFoundException|IncException $e) {
            return ResponseBuilder::error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return ResponseBuilder::error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return ResponseBuilder::success($result);
    }

    /**
     * @return JsonResponse
     */
    public function getAllVisitsCount()
    {
        try {
            $result = $this->counterService->getAllVisitsCount();
        } catch (Exception $e) {
            return ResponseBuilder::error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return ResponseBuilder::success($result);
    }
}
