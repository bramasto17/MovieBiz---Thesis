<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //
    public function index(){
    	return view('Register/index');
    }
    public function Register(Request $request){
    	$rules = array(
    			'txtUsername' => 'required | between:5,25',
    			'txtPassword' => 'required | min:5 | alpha_num',
    			'txtEmail' => 'required| email | unique:users,email',
    		);

    	$validator = Validator::make($request->all(),$rules);
    	$name = $request->txtUsername;
    	$password = $request->txtPassword;
      	$email = $request->txtEmail;

    	if ($validator->fails()){
    		return redirect('/register')->withErrors($validator);
    	}
    	else {
          DB::table('users')
            ->insert([
                'name' => $name,
                'password' => app('hash')->make($password),
                'email' => $email,
              ]);

           //login paakai email dan password
          $request = $request->create(route("login"), 'POST',
            array("txtEmail"=>$email,"txtPassword"=>$password,"_token"=> csrf_token()));
            return Route::dispatch($request);
	    }
    } 

}
