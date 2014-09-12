<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(){
		$this->beforeFilter('auth', array('except'=>array('validate')));
	}

	public function index()
	{
		$users = User::where('username', '!=', 'admin')->orderBy('id', 'DESC')->get();
        return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$user = User::where('username', $inputs['username'])->count();
		if($user == 0){
			$u =  User::create(array(
					'firstname'=>$inputs['fname'],
					'lastname'=>$inputs['lname'],
					'middlename'=>$inputs['mname'],
					'gender'=>$inputs['gender'],
					'username'=>$inputs['username'],
					'password'=>Hash::make(strtoupper($inputs['lname'])),
					'role'=>$inputs['level'],
					'updated_at'=> '0000-00-00 00:00:00'
				));
			return View::make('users.create')->with('msg', 'Successfully new User added');

		}else{
			return View::make('users.create')->with('emsg', 'Username exists! please choose another');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
        return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$inputs = Input::all();
		$us  = User::find($id);

		if($inputs['passrest'] == "yes"){

				if($us->username != $inputs['username']){
					$user = User::where('username', $inputs['username'])->count();
					if($user == 0){
						$us->firstname  = $inputs['fname'];
						$us->middlename = $inputs['mname'];
						$us->lastname   = $inputs['lname'];		
						$us->username   = $inputs['username'];
						$us->status     = $inputs['status'];
						$us->gender     = $inputs['gender'];
						$us->default    = "yes";
						$us->password   = Hash::make(strtoupper($inputs['lname']));
						$us->role       = $inputs['level'];
						$us->updated_at = '0000-00-00 00:00:00';
						$us->save();
						$user   = $us;
					    return View::make('users.edit', compact('user'))->with('msg', 'Successfully new User added');
					}else{
						return View::make('users.edit', compact('user'))->with('emsg', 'Username exists');
					}
				}else{

				$us->firstname  = $inputs['fname'];
				$us->middlename = $inputs['mname'];
				$us->lastname   = $inputs['lname'];		
				$us->username   = $inputs['username'];
				$us->status     = $inputs['status'];
				$us->gender     = $inputs['gender'];
				$us->default    = "yes";
				$us->password   = Hash::make(strtoupper($inputs['lname']));
				$us->role       = $inputs['level'];
				$us->updated_at = '0000-00-00 00:00:00';
				$us->save();
				$user   = $us;
			    return View::make('users.edit', compact('user'))->with('msg', 'Successfully new User added');

				}



		}else{
				if($us->username != $inputs['username']){
					$user = User::where('username', $inputs['username'])->count();
					if($user == 0){
						$us->firstname  = $inputs['fname'];
						$us->middlename = $inputs['mname'];
						$us->lastname   = $inputs['lname'];		
						$us->username   = $inputs['username'];
						$us->status     = $inputs['status'];
						$us->gender     = $inputs['gender'];
						$us->role       = $inputs['level'];
						$us->updated_at = '0000-00-00 00:00:00';
						$us->save();
						$user   = $us;
					    return View::make('users.edit', compact('user'))->with('msg', 'Successfully new User added');
					}else{
						return View::make('users.edit', compact('user'))->with('emsg', 'Username exists');
					}
				}else{

				$us->firstname  = $inputs['fname'];
				$us->middlename = $inputs['mname'];
				$us->lastname   = $inputs['lname'];		
				$us->username   = $inputs['username'];
				$us->status     = $inputs['status'];
				$us->gender     = $inputs['gender'];
				$us->role       = $inputs['level'];
				$us->updated_at = '0000-00-00 00:00:00';
				$us->save();
				$user   = $us;
			    return View::make('users.edit', compact('user'))->with('msg', 'Successfully new User added');

				}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$user = User::find($id);
		$user->delete();
	}
	
		public function validate(){
		$email     = Input::get('username');
		$password  = Input::get('password');
		$crets = array('username'=>$email, 'password'=>$password, 'status'=>'active');
		if(Auth::attempt($crets)){
			$default  = Auth::user()->default;
			$user_id  = Auth::user()->id;
			$user     = User::find($user_id);
			$user->updated_at =  date("Y-m-d H:i:s"); 
			$user->save();
			if($default  == "no"){
				return Redirect::to('home');
			}else{
				//redirect to change password box
				return Redirect::to('passchange');
			}
		}else{
			 return View::make("login")->with("error","Incorrect Username or Password");
		}
	}

	public function logout(){
        
        Auth::logout();
        return Redirect::to("/");
	}

	public function passchange(){
		return View::make("passchange");
	}

	public function paxchn(){
		if(Input::get('npax') == Input::get('cpax')){
			$user = User::find(Auth::user()->id);
			$user->default = "no";
			$user->password = Hash::make(Input::get('cpax'));
			$user->save();
			return Redirect::to('home');

		}else{
			return View::make('passchange')->with('emsg', 'Password mismatches');
		}
	}

}
