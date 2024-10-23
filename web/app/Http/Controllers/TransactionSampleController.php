<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class TransactionSampleController extends Controller
{
    public function normalGet()
    {
        $start = microtime(true);

        for ($i = 0; $i < 1000; $i++) {
            Post::find($i + 1);
        }

        $time = microtime(true) - $start;

        return response()->json(['time' => $time, 'action' => 'get']);
    }

    public function transactionGet()
    {
        $start = microtime(true);

        DB::transaction(function () {
            for ($i = 0; $i < 1000; $i++) {
                Post::find($i + 1);
            }
        });

        $time = microtime(true) - $start;

        return response()->json(['time' => $time, 'action' => 'get']);
    }

    public function normalCreate()
    {
        $start = microtime(true);

        for ($i = 0; $i < 1000; $i++) {
            Post::create([
                'title' => 'Normal Post ' . $i,
                'content' => 'This is a normal post.',
            ]);
        }

        $time = microtime(true) - $start;

        return response()->json(['time' => $time]);
    }

    public function transactionCreate()
    {
        $start = microtime(true);

        DB::transaction(function () {
            for ($i = 0; $i < 1000; $i++) {
                Post::create([
                    'title' => 'Transaction Post ' . $i,
                    'content' => 'This is a transaction post.',
                ]);
            }
        });

        $time = microtime(true) - $start;

        return response()->json(['time' => $time]);
    }

    public function normalUpdate()
    {
        $start = microtime(true);

        for ($i = 0; $i < 1000; $i++) {
            $post = Post::find($i + 1);
            if ($post) {
                $post->update([
                    'title' => 'Updated Normal Post ' . $i,
                    'content' => 'This is an updated normal post.',
                ]);
            }
        }

        $time = microtime(true) - $start;

        return response()->json(['time' => $time, 'action' => 'update']);
    }

    public function transactionUpdate()
    {
        $start = microtime(true);

        DB::transaction(function () {
            for ($i = 0; $i < 1000; $i++) {
                $post = Post::find($i + 1);
                if ($post) {
                    $post->update([
                        'title' => 'Updated Transaction Post ' . $i,
                        'content' => 'This is an updated transaction post.',
                    ]);
                }
            }
        });

        $time = microtime(true) - $start;

        return response()->json(['time' => $time, 'action' => 'update']);
    }
}
