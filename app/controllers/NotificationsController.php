<?php

class NotificationsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct(){
		$this->beforeFilter('auth', array('*'));
	}

	public function index()
	{
        return View::make('notifications.index');
	}

	public function solving($id){
		$note = Notification::find($id);
		$note->read = "yes";
		$note->save();

		$nit     = Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->count();

		return $nit;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function notify(){
		$n = Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->count();
		return $n;
	}

	public function create()
	{
        return View::make('notifications.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('notifications.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('notifications.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
	}

}
