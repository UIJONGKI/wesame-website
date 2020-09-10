<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gallery;
use App\Article;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Request $request, $slug = null, Article $article)
    {   
       
        $randoms = null;
        $artists=$user->where('artists', 1)->get();

        if ($artists->count() < 3){
            
        }else{

        $randoms = $artists->random(3);
        }
       
        $query = $slug ? \App\Gtag::whereSlug($slug)->firstOrFail()->galleries() : new \App\Gallery;

        $query = $query->orderBy(
            $request->input('sort', 'created_at'),
            $request->input('order', 'desc')
        );

        if ($keyword = request()->input('q')) {
            $raw = 'MATCH(title, content) AGAINST(? IN BOOLEAN MODE)';
            $query = $query->whereRaw($raw, [$keyword]);
        }
        $author=$user->where('admin', 1)->first();
        
        $userLv = $author->id;

        $news= Article::take(4)->where('user_id', $userLv)->orderBy(
            $request->input('sort', 'created_at'),
            $request->input('order', 'desc')
        )->get();
        $items = $query->take(6)->get();

        flash('환영합니다.');
        return view('home', compact('randoms', 'items', 'news'));
    }
}
