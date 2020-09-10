<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests\CommentsRequest;
use Illuminate\Http\Request;


class CommentsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(CommentsRequest $request, Article $article)
    {	
    	
    	$comment = $article->comments()->create(array_merge(
            $request->all(),
            ['user_id' => $request->user()->id]
        ));



    	return redirect(route('articles.show', $article->id).'#comment_'.$comment->id);
    }

    public function update(CommentsRequest $request, Comment $comment)
    {
    	$comment->update($request->all());

    	return redirect(route('articles.show', $comment->commentable->id).'#comment_'.$comment->id);
    }

    public function destroy(\App\Comment $comment)
    {
    	if($comment->replies->count() > 0) {
    		$comment->delete();	
    	} else {
    		$comment->forceDelete();
    	}
    	

    	return response()->json([],204);
    }
}
