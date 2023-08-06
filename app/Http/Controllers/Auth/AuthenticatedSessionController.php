<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();
        $source = $request->query('source');

        $role = Auth::user()->akses;

        // if ($source === 'cms' && $role === 1) {
        //     return redirect()->intended(RouteServiceProvider::HOME)
        //     ->withErrors(['message' => 'You cannot login from here.']);
        // }
        if ($role == 0){
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            return redirect('customer');
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $role = Auth::user()->akses;

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if ($role == 0){
            return redirect('/');
        }else{
            return redirect('customer');
        }

    }
}
