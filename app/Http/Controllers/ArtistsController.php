<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Gallery;
class ArtistsController extends Controller
{
    
    public function index(User $user)
    {

    	$artists = $user->where('artists', 1)->get();
        $advisors = $user->where('advisors', 1)->get();
    	return view('artists.index', compact('artists', 'advisors'));
    	
    }
    public function show(User $user, $id)
    {
    	$artist = $user->find($id);
    	$query = $artist->galleries();
    	$galleries = $query->paginate(3);
    	return view('artists.show', compact('artist', 'galleries'));
    }
    public function board(User $user, $id)
    {
        $artist = $user->find($id);
        $query = $artist->articles();
        $articles = $query->paginate(8);
        return view('artists.board', compact('artist', 'articles'));
    }
   
}
