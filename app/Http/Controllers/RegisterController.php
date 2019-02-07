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
    	$rules = [
    			'txtUsername' => 'required | between:5,25',
    			'txtPassword' => 'required | min:5 | alpha_num',
    			'txtEmail' => 'required| email | unique:users,email',
    		];
        $message = [
            'txtUsername.required' => 'Username is required',
            'txtUsername.between' => 'Username must be between 5 - 25 characters',
            'txtPassword.required' => 'Password is required',
            'txtPassword.min' => 'Password should consists atleast 5 characters',
            'txtPassword.alpha_num' => 'Password may only contain letters and numbers',
            'txtEmail.unique' => 'Email has already been taken',
        ];
    	$validator = Validator::make($request->all(),$rules,$message);
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
                'email' => $email
              ]);

          $request = $request->create(route("login"), 'POST',
            array("txtEmail"=>$email,"txtPassword"=>$password,"_token"=> csrf_token()));
            return Route::dispatch($request);
	    }
    } 

}
