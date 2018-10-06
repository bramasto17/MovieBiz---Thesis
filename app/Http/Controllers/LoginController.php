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
    	$rules = array(
    			'txtEmail' => 'required | email',
    			'txtPassword' => 'required | min:5'
    		);
    	$validator = Validator::make($request->all(),$rules);
    	$email = $request->input('txtEmail');
    	$password = $request->input('txtPassword');

    	if ($validator->fails()){
    		return redirect('/login')->withErrors($validator);
    	}
    	else if(Auth::attempt(['email'=>$email,'password'=>$password],false)){ 
          session()->put('Auth', Auth::user());
          session()->save();
          return redirect('/home')->with('message','Login Success');
	    } else { 
	    	return redirect('/login')->with('message','User Not Found');
	    } 
    } 

    public function Logout(){
        session()->flush();
        return redirect('/')->with('message','Logged Out');
    }
}
