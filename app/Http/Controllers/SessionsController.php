<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);        
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(! auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            //flash('이메일 또는 비밀번호가 맞지 않습니다.');
            //return back()->withInput();
            $message = '이메일 또는 비밀번호가 맞지 않습니다. (Email or Password is not matched)';
            return back()->with('alert',$message);
        }

        if (! auth()->user()->activated){
            auth()->logout();
            //flash('가입 확인해 주세요.');

            //return back()->withInput();
            $message = '이메일 인증 확인을 해주세요. (Please confirm the verifying email)';
            return back()->with('alert', $message);
        }

        

        return redirect('/');
    }

    protected function respondError($message)
    {
        flash()->error($message);

        return back()->withInput();
    }

    public function destroy()
    {
        auth()->logout();
       
        $message= '성공적으로 로그아웃 하였습니다. (Successfully Logged out)';
        return redirect('/')->with('alert', $message);
    }
}
