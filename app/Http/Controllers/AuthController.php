<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function handle(){
        if (!Auth::check()) {
            return redirect('/login');
        }else{
            return redirect('/dashboard');
        }
    }

    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        try{
            $credentials = $request->validate(
                [
                    "nip_or_email_field" => 'required',
                    "password" => 'required'
                ],       
            );

            if(
                Auth::attempt(['email' => $credentials['nip_or_email_field'], 'password' => $credentials['password'],'is_active' => 1]) 
                ||Auth::attempt(['nip' => $credentials['nip_or_email_field'], 'password' => $credentials['password'],'is_active' => 1])
            ){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }

            return back()->with('loginError', 'Login Failed');
            
        }catch(\Exception $e){
            return back()->with('loginError', 'Login Failed');
        }

    }

    public function unauthenticate(){
        Auth::logout();
        return redirect('/login');
    }

}
