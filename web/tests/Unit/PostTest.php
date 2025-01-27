<?php

namespace Tests\Unit;

use App\Models\Post;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        Post::create([
            'title' => 'Normal Post #1',
            'content' => 'This is a normal post #1.',
        ]);
        Post::create([
            'title' => 'Normal Post #2',
            'content' => 'This is a normal post #2.',
        ]);

        $posts = Post::all();
        $this->assertEquals(2, $posts->count());
    }

    public function test_upsert()
    {
        Post::create([
            'title' => 'Normal Post #1',
            'content' => 'This is a normal post #1.',
        ]);
        Post::create([
            'title' => 'Normal Post #2',
            'content' => 'This is a normal post #2.',
        ]);

        Post::upsert([
            [
                'title' => 'Upsert Post #1',
                'content' => 'This is an upsert post #1.',
            ],
            [
                'title' => 'Upsert Post #2',
                'content' => 'This is an upsert post #2.',
            ],
        ], ['title'], ['content']);

        $posts = Post::all();
        $this->assertEquals(4, $posts->count());
    }
}
