<?php

namespace App\Http\Controllers;

use App\Service\RandomNumberService;
use Illuminate\Http\Response;
use Laravel\Octane\Facades\Octane;

class SampleOctaneTablesController extends Controller
{
    public function __construct(
        private RandomNumberService $service
    ){}

    public function index(): Response
    {
        Octane::table('stats')->incr('page_views', 'count');
        $views = Octane::table('stats')->get('page_views', 'count');
        return response('page_views count: ' . $views, Response::HTTP_OK);
    }
}
