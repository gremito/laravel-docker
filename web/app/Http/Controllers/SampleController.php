<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\RandomService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SampleController extends Controller
{
    public function __construct(
        private RandomService $service
    ){}

    public function index(Request $request): Response
    {
        \Log::info("Request getAcceptableContentTypes: ", $request->getAcceptableContentTypes());
        return response("{}", Response::HTTP_OK);
    }

    public function getNumber(): Response
    {
        return response('RandomNumberService getNumber:' . $this->service->get_number(), Response::HTTP_OK);
    }

    public function number_of_apc_cache(): Response
    {
        Cache::store('apc')->forever("getNumber", $this->service->get_number());
        $num = Cache::store('apc')->get("getNumber", "-1");
        return response('Number:' . $num, Response::HTTP_OK);
    }

    public function number_of_redis_cache(): Response
    {
        Cache::store('redis')->forever("getNumber", $this->service->get_number());
        $num = Cache::store('redis')->get("getNumber", "-1");
        return response('Number:' . $num, Response::HTTP_OK);
    }

    public function long_key_value_apc_cache(): Response
    {
        $key = $this->service->str_random(100);
        $value = $this->service->str_random(1000);
        Cache::store('apc')->forever($key, $value);
        $cache = Cache::store('apc')->get($key, "-1");
        return response("key: {$key}\nvalue: {$cache}", Response::HTTP_OK);
    }

    public function long_key_value_redis_cache(): Response
    {
        $key = $this->service->str_random(100); 
        $value = $this->service->str_random(1000);
        Cache::store('redis')->forever($key, $value);
        $cache = Cache::store('redis')->get($key, "-1");
        return response("key: {$key}\nvalue: {$cache}", Response::HTTP_OK);
    }
}
