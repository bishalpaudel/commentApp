<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommentController extends BaseController
{
    use ValidatesRequests;

    public function getComments(Request $request, Comment $comment):Collection{
        return $comment->with("comments")->whereNull("comment_id")->get();
    }

    public function postComment(Request $request, Comment $comment){
        $this->validate($request, [
            'author' => 'required|string',
            'comment' => 'required|string',
            'parent' => 'numeric|exists:comments,id'
        ]);

        $parent = null;

        if($request->has('parent') AND $request->input('parent') != null){
            try{
                $parent = $comment->findOrFail($request->input('parent'));
            }catch (ModelNotFoundException $exception){
                /* TODO: Log this Exception */
                return response()->json([], 417);
            }

            $ok = $parent->hasDepthLessThan(env("MAX_COMMENT_DEPTH"));

            if(! $ok){
                /* TODO: return nice message */
                return response()->json([], 417);
            }
        }
        $comment->setComment($request->input('comment'));
        $comment->setAuthor($request->input('author'));
        $comment->setParent($parent);

        if(! $comment->save()){
            /* TODO: return nice message */
            return response()->json([], 417);
        }

        return response()->json(['comment'=>$comment], 201);
    }
}
