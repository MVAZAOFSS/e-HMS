<?php


class PasswordController extends BaseController{


	public function __construct(){
		$this->beforeFilter('auth', array('*'));
	}

	public function change(){
		$olpax = Input::get('olpax');
		$uid   = Auth::user()->id;
		$pax   = User::find($uid)->password;
		if(Hash::check($olpax, $pax)){
			return "good";
		}else{
			return 'bad';
		}
	}

	public function pax(){
		$newpass = Input::get('cpax');
		$uid   = Auth::user()->id;
		$user  = User::find($uid);
		$user->password = Hash::make($newpass);
		$user->save();
		return "ok";
	}

	public function show(){
		
	}

	public function update(){
		
	}
}