<?php

namespace App\Http\Controllers\Api;

use App\Service\RandomNumberService;
use Illuminate\Http\Response;

class SampleController extends Controller
{
    public function __construct(
        private RandomNumberService $service
    ){}

    public function index(): Response
    {
        return response("{ \"number\": {$this->service->getNumber()} }", Response::HTTP_OK);
    }
}
