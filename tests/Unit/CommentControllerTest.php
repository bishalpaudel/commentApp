<?php

namespace Tests\Unit;

use App\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    public function testGetComments()
    {
        $commentCollection = $this->getCommentsCollection();
        $comment = Mockery::mock(Comment::class);
        $comment->shouldReceive('get')->once()->andReturn($commentCollection);
        $comment->shouldReceive('with')->with('comments')->andReturnSelf();
        $comment->shouldReceive('whereNull')->with('comment_id')->andReturnSelf();

        $commentController = App::make('App\Http\Controllers\CommentController');
        $returnedCollection = $commentController->getComments(new Request(), $comment);

        $this->assertEquals($returnedCollection, $commentCollection);
    }

    private function getCommentsCollection():Collection{
        return factory(\App\Comment::class, 10)->make();
    }
}
