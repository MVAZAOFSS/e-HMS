<?php

class SystemController extends BaseController{
	
	public function login(){
		$admin = User::where('role', 1)->count();
		if($admin == 1){
			return View::make('system.login');
		}else{
			return View::make('system.wizard');
		}
		
	}

	public function validate(){
		$inputs = Input::except('_token');
		if(Auth::attempt($inputs)){
			$role  = Auth::user()->role;
			if($role == 1){
				return Redirect::to('system/config');
			}
		}else{
			 return View::make("system.login")->with("error","Incorrect Username or Password");
		}	
	}

	public function systemApp(){
		return View::make('system.system');
	}

	public function conf(){
		return View::make('system.conf');
	}

}