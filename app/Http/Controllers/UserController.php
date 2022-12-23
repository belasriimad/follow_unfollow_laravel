<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function registerForm(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('auth.register');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:100',
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        auth()->login($user);
        return redirect('/');
    }

    public function loginForm(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('auth.login');
    }

    public function auth(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            return redirect('/');
        }else{
            return redirect()->route('login')->with([
                'error' => 'These credentials do not match any of our records!'
            ]);
        }
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }

    public function follow($following_id, $follower_id){
        $follower = User::find($follower_id);
        $following = User::find($following_id);
        $follower->followings()->attach($following);
        return redirect()->back();
    }

    public function unfollow($following_id, $follower_id){
        $follower = User::find($follower_id);
        $following = User::find($following_id);
        $follower->followings()->detach($following);
        return redirect()->back();
    }
}
