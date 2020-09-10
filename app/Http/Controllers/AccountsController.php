<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\User;
use Image;
use File;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
class AccountsController extends Controller
{
    
    public function index(Request $request)
    {  
        if($request->user()==null){
            $message = '로그인이 필요합니다. (Login is needed.)';
            return back()->with('alert', $message);
        }
    	return view('accounts.index');
    }
 
    public function update(Request $request)
    {

    	$this->validate($request, [
    		'name' => 'required|max:255',
    		'password' => 'required|confirmed|min:6',

    	]);


        if(!auth()->attempt($request->only('email', 'password')))
        {
            $message = '비밀번호가 일치 하지않습니다. (password is not matched.)';
            return back()->with('alert',$message);
        }

        if( $request->has('newPassword'))
        {   
            $this->validate($request, [
                'newPassword' => 'min:6',
            ]);
            \App\User::whereEmail($request->input('email'))->first()->update([
            'password' => bcrypt($request->input('newPassword'))
            ]);

        }
        
        if ($request->name != $request->user()->name)
        {
            \App\User::whereEmail($request->input('email'))->first()->update([
            'name' => $request->input('name')
            ]);
        }
        $s3 = \Storage::disk('s3');
        if($request->hasFile('avatar')){    
            $this->validate($request, [
                
                'avatar' => "mimes:jpeg,png,jpg",
            ]);
            $user = $request->user();


            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $filePath='/files/avatars/'.$filename;
            $s3->put($filePath, file_get_contents($avatar), 'public');
            /*Image::make($avatar)->resize(300, 300)->save( public_path('/files/avatars/' . $filename ) );*/

            
            $user->avatar = $filename;
            $user->save();
        }



        $message = '회원정보 수정이 완료 되었습니다. (Successfully Edited)';
        return redirect('/')->with('alert', $message);
     
        
    }
    
}
