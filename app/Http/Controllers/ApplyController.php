<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gallery;
use App\Http\Requests\ApplyRequest;
use File;
use Mail;
class ApplyController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index (Request $request, User $user, Gallery $gallery)
    {

    	$applier = $request->user();
    	if($applier->galleries()->count()<3){

 			return back()->with('alert', '작품 3개이상 업로드시에만 작가 신청이 가능합니다.');
    	}

    	return view('apply.index', compact('applier'));
    			    
   	}

   	public function apply (ApplyRequest $request, User $user, Gallery $gallery) 
   	{
   		
   		$items=$request->user()->galleries()->get();
   		$urls[] = [];
   		$i = 0;
   		foreach ($items as $item) {
   			$id = $item->id;
   			$url = url('galleries/'. $item->id);
   			$urls[$i] = $url;
   			$i++;
   		}
   
   		$data = array(
   			'name' => $request->name,
   			'email' => $request->email,
   			'context' => $request->context,
   			'file' => $request->file('files'),
   			'items' => $urls
   		);

   		\Mail::send('emails.apply.apply', $data, function($message) use ($data){
   			$message->to('kidult.wesame@gmail.com');
   			$message->subject('[WESAME] 작가신청 메일입니다.');
   			$message->from($data['email']);
   			if (isset($data['file'])){
				$message->attach($data['file'][0]->getRealPath(), array(
	    			'as' => 'file.' . $data['file'][0]->getClientOriginalExtension(),
	    			'mime' => $data['file'][0]->getMimeType())
    			);
    		}

   		});

   		return Redirect('/');
   	}
}
