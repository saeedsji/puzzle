<?php

namespace App\Http\Controllers;

use App\lib\auth\LoginClass;
use App\Rules\PhoneExist;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function loginPost(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => ['required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric', new PhoneExist()],
            'password' => 'required',
            'captcha' => 'required|captcha',
        ]);
        $loginClass = new LoginClass();
        $passwordLogin = $loginClass->passwordLogin($validatedData['phone'], $validatedData['password']);
        
        if ($passwordLogin['success'])
        {
            auth()->loginUsingId($passwordLogin['user_id']);
            toast($passwordLogin['message'], 'success');
            return redirect(route('dashboard'));
        }
        else
        {
            alert()->error('ورود ناموفق', $passwordLogin['message']);
            return back();
        }
    }
    
    
    public function logout()
    {
        if (auth()->check())
        {
            auth()->logout();
            return redirect(route('login'));
        }
    }
}
