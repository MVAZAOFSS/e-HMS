<?php

class BarsController extends BaseController {

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
		$bars = Bar::all();
        return View::make('bars.index', compact('bars'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('bars.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$room = Bar::where('name', $inputs['name'])->count();
		if($room == 0){

			$r = Bar::create($inputs);
			return View::make('bars.create')->with('msg', 'Successfully, added ');
		}else{
			return View::make('bars.create')->with('emsg', 'Drink exists! please choose another');
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
		$drink = Bar::find($id);
        return View::make('bars.edit', compact('drink'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$drink   = Bar::find($id);
		$inputs = Input::all();
		$name = $drink->name;
		if($name != $inputs['name']){
			$r = Bar::where('name', $inputs['name'])->count();
			if($r==0){
				$drink->name = $inputs['name'];
				$drink->cost = $inputs['cost'];
				$drink->save();
				return View::make('bars.edit', compact('drink'))->with('msg', 'Successfully updated');
			}else{
				return View::make('bars.edit', compact('drink'))->with('emsg', 'Drink exists');
			}
		}else{
				$drink->name = $inputs['name'];
				$drink->cost = $inputs['cost'];
				$drink->save();
				return View::make('bars.edit', compact('drink'))->with('msg', 'Successfully updated');
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
		$d = Bar::find($id);
		$d->delete();
	}

}
