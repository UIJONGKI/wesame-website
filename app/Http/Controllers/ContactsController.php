<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use File;
use Mail;
use Session;
use Image;

class ContactsController extends Controller
{
    public function index()
    {
    	return view('contacts.index');
    }
    public function send(ContactsRequest $request)
    {	
    	$data = array(
    		'category' => $request->category,
    		'name' => $request->name,
    		'email' => $request->email,
    		'subject' => $request->subject,
    		'context' => $request->context,
    		'file' => $request->file('files')
    		 		
    	);

    	\Mail::send('emails.contacts.send', $data, function($message) use ($data) {
    		$message->to('kidult.wesame@gmail.com');
    		$message->subject($data['subject']);
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
