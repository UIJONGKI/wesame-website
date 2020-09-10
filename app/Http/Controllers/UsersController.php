<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //$socialUser = \App\User::whereEmail($request->input('email'))->whereNull('password')->first();


        if ($socialUser = \App\User::socialUser($request->get('email'))->first()) {
            return $this->updateSocialAccount($request, $socialUser);
        }

        return $this->createNativeAccount($request);
    }

    protected function updateSocialAccount(Request $request, \App\User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->update([
            'name'  => $request->input('name'),
            'password' => bcrypt($request->input('password')),
        ]);

        auth()->login($user);

        return redirect('/');
    }

    public function createNativeAccount(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:6',
        ]);

        $confirmCode = str_random(60);

        $user = \App\User::create([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode,
        ]);

        event(new \App\Events\UserCreated($user));

        $message = "가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다. 가입 확인하시고 로그인 해주세요.";
        //flash('가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다. 가입 확인하시고 로그인 해주세요.');

        //return redirect('/');
        return redirect('/')->with('alert', $message);
     
    }

    protected function respondCreated($message)
    {
        flash($message);

        return redirect('/');
    }

    public function confirm($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();

        if (! $user) {
            $message= 'URL이 정확하지 않습니다.';

            return redirect('/')->with('alert', $message);
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);

        return redirect('/');
    }


}
