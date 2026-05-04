<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'agent') {
                return redirect()->route('agent.tickets');
            }

            return redirect()->route('tickets.index');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }
}