<?php

// namespace Tests\Unit;

// // use PHPUnit\Framework\TestCase;
// use App\Models\Post;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Support\Facades\DB;
// use Tests\TestCase;

// class PostTest extends TestCase
// {
//     use RefreshDatabase;

//     // public function test_create()
//     // {
//     //     Post::create([
//     //         'title' => 'Normal Post #1',
//     //         'content' => 'This is a normal post #1.',
//     //     ]);
//     //     Post::create([
//     //         'title' => 'Normal Post #2',
//     //         'content' => 'This is a normal post #2.',
//     //     ]);

//     //     $posts = Post::all();
//     //     $this->assertEquals(2, $posts->count());
//     // }

//     // public function test_upsert()
//     // {
//     //     $post1 = Post::create([
//     //         'title' => 'Normal Post #1',
//     //         'content' => 'This is a normal post #1.',
//     //     ]);
//     //     $post2 = Post::create([
//     //         'title' => 'Normal Post #2',
//     //         'content' => 'This is a normal post #2.',
//     //     ]);

//     //     Post::upsert([
//     //         [
//     //             'id' => $post1->id,
//     //             'title' => 'Upsert Post #1',
//     //             'content' => 'This is an upsert post #1.',
//     //         ],
//     //         [
//     //             'id' => $post2->id,
//     //             'title' => 'Upsert Post #2',
//     //             'content' => 'This is an upsert post #2.',
//     //         ],
//     //     ], ['id'], ['title', 'content']);

//     //     Post::upsert([
//     //         [
//     //             'title' => 'Upsert Post #3',
//     //             'content' => 'This is an upsert post #3.',
//     //         ],
//     //         [
//     //             'title' => 'Upsert Post #4',
//     //             'content' => 'This is an upsert post #4.',
//     //         ],
//     //     ], ['id'], ['title', 'content']);
        
//     //     $posts = Post::all();
//     //     $this->assertEquals(4, $posts->count());
//     //     $this->assertEquals('Upsert Post #1', $posts[0]->title);
//     //     $this->assertEquals('Upsert Post #2', $posts[1]->title);
//     //     $this->assertEquals('Upsert Post #3', $posts[2]->title);
//     //     $this->assertEquals('Upsert Post #4', $posts[3]->title);
//     // }

//     // public function test_separate_connection_insert()
//     // {
//     //     DB::connection("mst")->table("posts")->insert([
//     //         'title' => 'Normal Post #1',
//     //         'content' => 'This is a normal post #1.',
//     //     ]);
//     //     DB::connection("mst")->table("posts")->insert([
//     //         'title' => 'Normal Post #2',
//     //         'content' => 'This is a normal post #2.',
//     //     ]);

//     //     $posts = DB::connection("mysql")->table("posts")->get();
//     //     $this->assertEquals(2, $posts->count());
//     // }

//     public function test_separate_connection_upsert()
//     {
//         DB::connection("mst")->table("posts")->insert([
//             'title' => 'Normal Post #1',
//             'content' => 'This is a normal post #1.',
//         ]);
//         DB::connection("mst")->table("posts")->insert([
//             'title' => 'Normal Post #2',
//             'content' => 'This is a normal post #2.',
//         ]);

//         $posts = DB::connection("mysql")->table("posts")->get();
//         $this->assertEquals(2, $posts->count());
//         DB::disconnect('mysql');

//         DB::connection("mst")->table("posts")->upsert([
//             [
//                 'id' => $posts[0]->id,
//                 'title' => 'Upsert Post #1',
//                 'content' => 'This is an upsert post #1.',
//             ],
//             [
//                 'id' => $posts[1]->id,
//                 'title' => 'Upsert Post #2',
//                 'content' => 'This is an upsert post #2.',
//             ],
//         ], ['id'], ['title', 'content']);

//         DB::connection("mst")->table("posts")->upsert([
//             [
//                 'title' => 'Upsert Post #3',
//                 'content' => 'This is an upsert post #3.',
//             ],
//             [
//                 'title' => 'Upsert Post #4',
//                 'content' => 'This is an upsert post #4.',
//             ],
//         ], ['id'], ['title', 'content']);

//         $posts = DB::connection("mysql")->table("posts")->get();
//         $this->assertEquals(4, $posts->count());
//         $this->assertEquals('Upsert Post #1', $posts[0]->title);
//         $this->assertEquals('Upsert Post #2', $posts[1]->title);
//         $this->assertEquals('Upsert Post #3', $posts[2]->title);
//         $this->assertEquals('Upsert Post #4', $posts[3]->title);
//     }
// }
