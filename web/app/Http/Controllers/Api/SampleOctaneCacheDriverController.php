<?php

namespace App\Http\Controllers\Api;

use App\Service\RandomService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SampleOctaneCacheDriverController extends Controller
{
    public function __construct(
        private RandomService $service
    ){}

    public function index(): Response
    {
        Cache::store('octane')->forever("getNumber", $this->service->getNumber());
        $num = Cache::store('octane')->get("getNumber", "-1");
        return response("{ \"number\": {$num} }", Response::HTTP_OK);
    }
}
