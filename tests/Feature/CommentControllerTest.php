<?php

namespace Tests\Feature;

use App\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    public function testHome()
    {
        $response = $this->get("/");
        $response->assertStatus(200);
    }

    public function testGetComments()
    {
        $commentCollection = $this->getCommentsCollection();

        $comment = Mockery::mock(Comment::class);

        $comment->shouldReceive('get')->once()->andReturn($commentCollection);
        $comment->shouldReceive('with')->with('comments')->andReturnSelf();
        $comment->shouldReceive('whereNull')->with('comment_id')->andReturnSelf();

        App::instance(\App\Comment::class, $comment);

        $response = $this->get("/api/comments");
        $response->assertStatus(200);
        $response->assertExactJson($commentCollection->toArray());
    }

    private function getCommentsCollection():Collection{
        return factory(\App\Comment::class, 10)->make();
    }

    public function testPostComments_ValidParams_ShouldPass(){
        $parent = Mockery::mock(\App\Comment::class);
        $parent->shouldReceive("hasDepthLessThan")->with(env("MAX_COMMENT_DEPTH"))->once()->andReturn(true);

        $comment = Mockery::mock(\App\Comment::class);
        $comment->shouldReceive('save')->once()->andReturn(true);
        $comment->shouldReceive("findOrFail")->once()->with(1)->andReturn($parent);
        $comment->shouldReceive("setComment")->once()->andReturnNull();
        $comment->shouldReceive("setAuthor")->once()->andReturnNull();
        $comment->shouldReceive("setParent")->once()->with($parent)->andReturnNull();
        $comment->shouldReceive('jsonSerialize')->once()->andReturn(["author"=>" Bishal Paudel","comment"=>"jsdf", "parent"=>1]);

        App::instance(\App\Comment::class, $comment);

        $response = $this->post("/api/comments", ["author"=>" Bishal Paudel","comment"=>"jsdf", "parent"=>1]);
        $response->assertStatus(201);
        $response->assertExactJson(["comment"=>["author"=>" Bishal Paudel","comment"=>"jsdf", "parent"=>1]]);
    }
}
