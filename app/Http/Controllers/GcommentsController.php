<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Gcomment;
use App\Http\Requests\GcommentsRequest;
use Illuminate\Http\Request;

class GcommentsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(GcommentsRequest $request, Gallery $gallery)
    {	
    	
    	$gcomment = $gallery->gcomments()->create(array_merge(
            $request->all(),
            ['user_id' => $request->user()->id]
        ));


    	return redirect(route('galleries.show', $gallery->id).'#comment_'.$gcomment->id);
    }

    public function update(GcommentsRequest $request, Gcomment $gcomment)
    {
    	$gcomment->update($request->all());

    	return redirect(route('galleries.show', $gcomment->commentable->id).'#comment_'.$gcomment->id);
    }

    public function destroy(\App\Gcomment $gcomment)
    {
    	if($gcomment->replies->count() > 0) {
    		$gcomment->delete();	
    	} else {
    		$gcomment->forceDelete();
    	}
    	

    	return response()->json([],204);
    }
}
