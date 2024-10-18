<?php

namespace App\Http\Controllers\Api;

use App\Service\RandomService;
use Illuminate\Http\Response;
use Laravel\Octane\Facades\Octane;

class SampleOctaneTablesController extends Controller
{
    public function __construct(
        private RandomService $service
    ){}

    public function index(): Response
    {
        Octane::table('stats')->incr('page_views', 'count');
        $count = Octane::table('stats')->get('page_views', 'count');
        return response("{ \"count\": {$count} }", Response::HTTP_OK);
    }
}
