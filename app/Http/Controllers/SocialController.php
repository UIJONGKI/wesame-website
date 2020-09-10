<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}
	 /**
     * Handle social login process.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $provider
     * @return \App\Http\Controllers\Response
     */
    public function execute(Request $request, $provider)
    {
        if (! $request->has('code')) {
            return $this->redirectToProvider($provider);
        }
        return $this->handleProviderCallback($provider);
    }
    /**
     * Redirect the user to the Social Login Provider's authentication page.
     *
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from the Social Login Provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function handleProviderCallback($provider)
    {
        $user = \Socialite::driver($provider)->user();

        $user = (\App\User::whereEmail($user->getEmail())->first()) ?: \App\User::create([
        	'name' => $user->getName() ?: 'unknown',
        	'email' => $user->getEmail(),
        	'activated' => 1,
        	]);
        auth()->login($user);
        $message = auth()->user()->name . '님 환영합니다. 가입 확인되었습니다.';
        return redirect('/')->with('alert', $message);
    }

}
