<?php

namespace App\Http\Controllers;

use App\Service\RandomService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Laravel\Octane\Facades\Octane;

class SampleOctaneCacheController extends Controller
{
    public function __construct(
        private RandomService $service
    ){}

    public function index(): Response
    {
        Cache::store('octane')->forever("getNumber", $this->service->get_number());
        $num = Cache::store('octane')->get("getNumber", "-1");
        return response('Number:' . $num, Response::HTTP_OK);
    }

    public function octane_table(): Response
    {
        Octane::table('stats')->incr('page_views', 'count');
        $views = Octane::table('stats')->get('page_views', 'count');
        return response('page_views count: ' . $views, Response::HTTP_OK);
    }

    public function long_key_value_cache(): Response
    {
        $key = $this->service->str_random(68);
        $value = $this->service->str_random(1000);
        Cache::store('octane')->forever($key, $value);
        $cache = Cache::store('octane')->get($key, "-1");
        return response("key: {$key}\nvalue: {$cache}", Response::HTTP_OK);
    }
}
