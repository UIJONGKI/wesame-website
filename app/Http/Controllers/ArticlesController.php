<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Http\Requests\ArticlesRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use File;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    public function index(Request $request, $slug = null, User $user)
    {
        $authors=$user->where('artists', 1);
        $author=$user->where('admin', 1)->first();

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

        $articles = $query->latest()->paginate(8);

        return view('articles.index', compact('articles', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new \App\Article;

        return view('articles.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ArticlesRequest $request)
    {

        $user = $request->user();
        //$article = $request->user()->articles()->create($request->all());
        $article = $user->articles()->create($request->getPayload());

//        $article = \App\User::find(10)->articles()->create($request->all());
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $file->move(attachments_path(), $filename);
                
                $article->attachments()->create([
                    'filename' => $filename,
                    'bytes' => $file->getClientSize(),
                    'mime' => $file->getClientMimeType(),
                ]);
            }
        }

        if (! $article) {
            return back() ->with('flash_message', "글이 저장되지 않았습니다.")->withInput();
        }
        //태그 싱크
        $article->tags()->sync($request->input('tags'));


        //첨부파일 연결
        /*$request->getAttachments()->each(function ($attachment) use ($article) {
            $attachment->article()->associate($article);
            $attachment->save();
        });*/

        event(new \App\Events\ArticlesEvent($article));

        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Article $article)
    {
        $article->view_count += 1;
        $article->save();
        $comments = $article->comments()->with('replies')->withTrashed()->whereNull('parent_id')->latest()->get();
        return view('articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ArticlesRequest $request, \App\Article $article)
    {
        
        $article = Article::find($article->id);

//        $article = \App\User::find(10)->articles()->create($request->all());
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $file->move(attachments_path(), $filename);
                
                $article->attachments()->create([
                    'filename' => $filename,
                    'bytes' => $file->getClientSize(),
                    'mime' => $file->getClientMimeType(),
                ]);
            }
        }
        $this->authorize('update', $article);
         $payload = array_merge($request->all(), [
            'notification' => $request->has('notification'),
        ]);
        $article->update($payload);
        $article->tags()->sync($request->input('tags'));
        flash()->success('수정하신 내용을 저장했습니다.');

        return redirect(route('articles.show', $article->id));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Article $article)
    {
        $this->authorize('delete', $article);
        $this->deleteAttachments($article->attachments);
        $article->delete();

        return response()->json([], 204, [], JSON_PRETTY_PRINT);
    }
    public function deleteAttachments(Collection $attachments)
    {
        $attachments->each(function ($attachment) {
            $filePath = attachments_path($attachment->filename);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            return $attachment->delete();
        });
    }
    public function delete(Request $request, $id)
    {

        $article = \App\Article::find($id);
        $this->authorize('delete', $article);
        $this->deleteAttachments($article->attachments);
        return redirect(route('articles.edit', $article->id));

    }

}
