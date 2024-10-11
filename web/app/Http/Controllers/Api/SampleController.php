<?php

namespace App\Http\Controllers\Api;

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
        Cache::store('apc')->forever("getNumber", $this->service->getNumber());
        $num = Cache::store('apc')->get("getNumber", "-1");
        return response("{ \"number\": {$num} }", Response::HTTP_OK);
    }
}
