<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Http\Requests\ArticlesRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use File;

class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    public function index(Request $request, $slug = null, User $user)
    {
        $authors=$user->where('level', 1)->get();
        $author=$user->where('level', 1)->first();
        $userLv = $author->id;

        $query = $slug
            ? \App\Tag::whereSlug($slug)->firstOrFail()->articles()
            : new \App\Article;
        $specific = $query->where('user_id', $userLv);
        $query = $specific->orderBy(
            $request->input('sort', 'created_at'),
            $request->input('order', 'desc')
        );
        if ($keyword = request()->input('q')) {
            $raw = 'MATCH(title, content) AGAINST(? IN BOOLEAN MODE)';
            $query = $query->whereRaw($raw, [$keyword]);
        }

        $articles = $query->latest()->paginate(5);
        return view('articles.index', compact('articles', 'authors'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
