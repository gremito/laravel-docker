<?php

namespace App\Http\Controllers\Api;

use App\Service\RandomNumberService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return response("{ \"number\": {$this->service->getNumber()} }", Response::HTTP_OK);
    }
}
