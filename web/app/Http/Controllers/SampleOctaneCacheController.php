<?php

namespace App\Http\Controllers;

use App\Service\RandomNumberService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Laravel\Octane\Facades\Octane;

class SampleOctaneCacheController extends Controller
{
    public function __construct(
        private RandomNumberService $service
    ){}

    public function index(): Response
    {
        Cache::store('octane')->forever("getNumber", $this->service->getNumber());
        $num = Cache::store('octane')->get("getNumber", "-1");
        return response('Number:' . $num, Response::HTTP_OK);
    }

    public function octaneTable(): Response
    {
        Octane::table('stats')->incr('page_views', 'count');
        $views = Octane::table('stats')->get('page_views', 'count');
        return response('page_views count: ' . $views, Response::HTTP_OK);
    }
}
