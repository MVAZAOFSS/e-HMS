<?php

class RestaurantsController extends BaseController {



	public function __construct(){
		$this->beforeFilter('auth', array('*'));
	}
		/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rests = Restaurant::all();
        return View::make('restaurants.index', compact('rests'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('restaurants.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$rest = Restaurant::where('name', $inputs['name'])->count();
		if($rest == 0){

			$r = Restaurant::create($inputs);
			return View::make('restaurants.create')->with('msg', 'Successfully, added ');
		}else{
			return View::make('restaurants.create')->with('emsg', 'Food exists! please choose another');
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
        return View::make('bars.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$rest = Restaurant::find($id);
        return View::make('restaurants.edit', compact('rest'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rest   = Restaurant::find($id);
		$inputs = Input::all();
		$name = $rest->name;
		if($name != $inputs['name']){
			$r = Restaurant::where('name', $inputs['name'])->count();
			if($r==0){
				$rest->name = $inputs['name'];
				$rest->cost = $inputs['cost'];
				$rest->save();
				return View::make('restaurants.edit', compact('rest'))->with('msg', 'Successfully updated');
			}else{
				return View::make('restaurants.edit', compact('rest'))->with('emsg', 'Food exists');
			}
		}else{
				$rest->name = $inputs['name'];
				$rest->cost = $inputs['cost'];
				$rest->save();
				return View::make('restaurants.edit', compact('rest'))->with('msg', 'Successfully updated');
		}
	}
        public function destroy($id)
	{
		$f = Restaurant::find($id);
		$f->delete();
	}
        function update_resta($id){
            $data['viewID']=$id;
            $input=Input::all();
            $roles=array(
                'amount'=>'required|numeric'
            );
            $validator=Validator::make($input,$roles);
            if($validator->fails()){
                return View::make('guests.restDetails',$data)->withError($validator);
            }  else {
                $remain=  Restaurant::where('id',$id)->first();
                $cost=$remain->remain;
                if(Input::get('amount') < $cost){
                    $costz=$cost-Input::get('amount');
                    $table_up=array(
                    'amount'=>Input::get('amount'),
                    'remain'=>$costz 
                ); 
                DB::table('foodbills')->where('id',$id)->update($table_up);
                $data['sms']='<p class="alert alert-success">Successifully updated</p>';
                return View::make('guests.restDetails',$data);
                }  else {
                 $costz=$cost-Input::get('amount');
                    $table_up=array(
                    'amount'=>Input::get('amount'),
                    'remain'=>$costz, 
                    'cleared'=>'yes'
                ); 
                DB::table('foodbills')->where('id',$id)->update($table_up);
                $data['sms']='<p class="alert alert-success">Successifully updated</p>';
                return View::make('guests.restDetails',$data);
                }
            } 
                
            }
        }


