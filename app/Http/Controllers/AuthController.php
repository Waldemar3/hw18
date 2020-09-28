<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function auth(){
        $validator = \Illuminate\Support\Facades\Validator::make(
            request()->all(),
            [
                'username' => 'required|min:3|max:16',
                'password' => 'required|min:6|max:50',
            ]
        );
        $credentials = [
            'username' => request()->get('username'),
            'password' => request()->get('password'),
        ];

        $remember = request()->get('remember') === 'on';

        if(!$validator->fails()){
            if(!Auth::attempt($credentials, $remember)){
                return redirect('/')->withErrors(['login' => 'Username or password incorrect']);
            }
        }else{
            return redirect('/')->withErrors($validator->errors());
        }


        return redirect('/links');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
