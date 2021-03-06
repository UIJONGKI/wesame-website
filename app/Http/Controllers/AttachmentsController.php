<?php

namespace App\Http\Controllers;

use App\Gallery_Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function store(Request $request)
    {
    	$attachments = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $payload = [
                    'filename' => $filename,
                    'bytes' => $file->getClientSize(),
                    'mime' => $file->getClientMimeType()
                ];
                $file->move(attachments_path(), $filename);
                $attachments[] = ($id = $request->input('gallery_id'))
                    ? \App\Gallery::findOrFail($id)->attachments()->create($payload)
                    : Gallery_Attachment::create($payload);
            }
        } else{
            return response()->json('File not passed !', 422);
        }
        
        return response()->json($attachments, 200, [], JSON_PRETTY_PRINT);
    }

    public function destroy(Attachment $attachment)
    {
        dd($attachment);
    	$path = attachments_path($attachment->name);

    	if (\File::exists($path)) {
            \File::delete($path);
        }
        $attachment->delete();

        return response()->json(
            $attachment,
            200,
            [],
            JSON_PRETTY_PRINT
        );
    }

    public function show($file)
    {
        $path = attachments_path($file);

        if(! \File::exists($path)) {
            abort(404);
        }

        $image =\Image::make($path);

        return response($image->encode('png'), 200, [
            'Content-Type' => 'image/png'
        ]);
    }
}
