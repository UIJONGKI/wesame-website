<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\GalleriesRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use File;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
class GalleriesController extends Controller
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
    public function index(Request $request, $slug = null)
    {
        
        $query = $slug ? \App\Gtag::whereSlug($slug)->firstOrFail()->galleries() : new \App\Gallery;

        $query = $query->orderBy(
            $request->input('sort', 'created_at'),
            $request->input('order', 'desc')
        );

        if ($keyword = request()->input('q')) {
            $raw = 'MATCH(title, content) AGAINST(? IN BOOLEAN MODE)';
            $query = $query->whereRaw($raw, [$keyword]);
        }


        $galleries = $query->paginate(12);

        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gallery = new \App\Gallery;

        return view('galleries.create', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\GalleriesRequest $request)
    {

        $user = $request->user();
        $gallery = $user->galleries()->create($request->getPayload());
        $s3 = \Storage::disk('s3');
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $filePath='/files/'.$filename;
                $s3->put($filePath, file_get_contents($file), 'public');
                /*$file->move(attachments_path(), $filename);*/
                
                $gallery->attachments()->create([
                    'filename' => $filename,
                    'bytes' => $file->getClientSize(),
                    'mime' => $file->getClientMimeType(),
                ]);
            }
        }

        
        
        if (! $gallery) {
            return back()->with('alert', "글이 저장되지 않았습니다. (Failed to upload)")->withInput();
        }
        //첨부파일 연결
        /*$request->getAttachments()->each(function ($attachment) use ($gallery) {
            $attachment->gallery()->associate($gallery);
            $attachment->save();
        });*/
        //태그 싱크
        $gallery->gtags()->sync($request->input('gtags'));

        event(new \App\Events\GalleriesEvent($gallery));
        if ($user->galleries()->count()==3){
            return redirect(route('galleries.index'))->with('alert', '얿로드한 작품 수가 3개가 되어 작가신청이 가능합니다! WESAME 작가가 되어보세요!');
        }
        return redirect(route('galleries.index'))->with('alert', '작품 업로드가 완료 되었습니다. (Successfully Uploaded)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Gallery $gallery)
    {
        $gallery->view_count += 1;
        $gallery->save();
        $gcomments = $gallery->gcomments()->with('replies')->withTrashed()->whereNull('parent_id')->latest()->get();
        return view('galleries.show', compact('gallery', 'gcomments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Gallery $gallery)
    {
        $this->authorize('update', $gallery);
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\GalleriesRequest $request, \App\Gallery $gallery)
    {


        /*$user= $request->user();*/
        $gallery = Gallery::find($gallery->id);
        $s3 = \Storage::disk('s3');
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $filePath='/files/'.$filename;
                $s3->put($filePath, file_get_contents($file), 'public');
                /*$file->move(attachments_path(), $filename);*/
                
                $gallery->attachments()->create([
                    'filename' => $filename,
                    'bytes' => $file->getClientSize(),
                    'mime' => $file->getClientMimeType(),
                ]);
            }
        }
        
        $this->authorize('update', $gallery);
         $payload = array_merge($request->all(), [
            'notification' => $request->has('notification'),
        ]);

        $gallery->update($payload);
        
        $gallery->gtags()->sync($request->input('gtags'));


        return redirect(route('galleries.show', $gallery->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, \App\Gallery $gallery)
    {
        $this->authorize('delete', $gallery);
        $gallery->delete();

        return response()->json([], 204);
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

        $gallery = \App\Gallery::find($id);
        $this->authorize('delete', $gallery);
        $this->deleteAttachments($gallery->attachments);
        return redirect(route('galleries.edit', $gallery->id));

    }
}
