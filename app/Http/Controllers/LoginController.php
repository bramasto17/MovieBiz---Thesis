<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class LoginController extends Controller
{
    //
    public function index(){
        $popular = Session::get('popular');

    	return view('Login\index')->with(['popular'=>$popular]);
    }
    public function Login(Request $request){
    	//login pakai email & password
    	$rules = [
    			'txtEmail' => 'required | email',
    			'txtPassword' => 'required | min:5'
    		];
    	$messages = [
    	    'txtPassword.min' => 'Password should consists atleast 5 characters',
            'txtPassword.required' => 'Password is required',
        ];
    	$validator = Validator::make($request->all(),$rules,$messages);
    	$email = $request->input('txtEmail');
    	$password = $request->input('txtPassword');

    	if ($validator->fails()){
    		return redirect('/login')->withErrors($validator);
    	}
    	else if(Auth::attempt(['email'=>$email,'password'=>$password],false)){ 
            if(Auth::user()->active()){
                session()->put('Auth', Auth::user());
                session()->save();
                return redirect('/home')->with('message','Login Success');
            }
            else{
                return redirect('/login')->with('message','User are banned by admin');
            }
	    } else { 
	    	return redirect('/login')->with('message','User Not Found');
	    } 
    } 

    public function Logout(){
        session()->flush();
        return redirect('/')->with('message','Logged Out');
    }
}
