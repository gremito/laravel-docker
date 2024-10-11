<?php

namespace App\Http\Controllers;

use App\Service\RandomNumberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SampleController extends Controller
{
    public function __construct(
        private RandomNumberService $service
    ){}

    public function index(Request $request): Response
    {
        \Log::info("Request getAcceptableContentTypes: ", $request->getAcceptableContentTypes());
        return response("{}", Response::HTTP_OK);
    }

    public function getNumber(): Response
    {
        return response('RandomNumberService getNumber:' . $this->service->getNumber(), Response::HTTP_OK);
    }

    public function numberOfRedisCache(): Response
    {
        Cache::store('redis')->forever("getNumber", $this->service->getNumber());
        $num = Cache::store('redis')->get("getNumber", "-1");
        return response('Number:' . $num, Response::HTTP_OK);
    }

    public function numberOfApcCache(): Response
    {
        Cache::store('apc')->forever("getNumber", $this->service->getNumber());
        $num = Cache::store('apc')->get("getNumber", "-1");
        return response('Number:' . $num, Response::HTTP_OK);
    }
}
