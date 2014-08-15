<?php

class GuestsController extends BaseController {


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
		$guests = Guest::all();
        return View::make('guests.index', compact('guests'));
	}

	public function checkouts(){
		return View::make('guests.checkouts');
	}

	public function confirm($id){
		$guest = Guest::find($id);
		$guest->reserved = 'no';
		$guest->confirm  = 'yes';
		$room_number = $guest->room_number;
		$r           = Room::find($room_number);
		$r->status   = "occupied";
		$r->save();
		$guest->save();

		$n = Guest::where('reserved', '!=', 'no')->count();
		return $n;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */



	public function moredays(){

		$inputs       = Input::all();

		$room           = Room::find($inputs['rmid']);
		$guest          = Guest::find($inputs['gid']);

		$checkout      = $room->checkout;

		$arrival       = $guest->arrival_date;
		$departure     = $guest->departure_date;
		
		$checkin       = $room->checkin;

		$arr1         = strtotime($checkout);
		$arr2         = strtotime($departure);

		$days         = $inputs['days'];
		
		$tm1          = $arr1 + $days * 86400;
		$tm2          = $arr2 + $days * 86400;

		$newCheckout1 = date('Y-m-d', $tm1);
		$newCheckout2 = date('Y-m-d', $tm2);

		$room->checkout = $newCheckout1;
		$guest->departure_date = $newCheckout2;

		$guest->save();
		$room->save();



		$dys = Guest::generateDays($arrival, $newCheckout2);


		foreach ($dys as $d) {
			# code...
			
			$log = HotelLogs::whereRaw('date = ? and guestid = ?', array($d, $inputs['gid']))->count();
			if($log == 0){
			$lg  = HotelLogs::create(array(
						"guestid"=>$inputs['gid'],
						"date"=>$d
				));
			}
		}

		$n         = Notification::whereNidAndRead($inputs['gid'], 'no')->count();
		if($n != 0){
			$note    = Notification::whereNidAndRead($inputs['gid'], 'no')->first();
			$note->read = 'yes';
			$note->save();		
			$nit     = Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->count();	
		}else{
			$nit     = Notification::whereToAndReadAndRemoved('secretary', 'no', 'no')->count();
		}


		
		
		return json_encode(array("nid"=>$nit,"checkin"=>$checkin, "checkout"=>$newCheckout2, "rom"=>$room->name));
	
	}

	public function create()
	{
		//$rooms = DB::table('rooms', '!=', 'occupied')->get();
        $rooms   = Room::where('status', '!=', 'occupied')->get();
        return View::make('guests.create', compact('rooms'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function rno(){
		$rno = Input::get('t');
		$rn  = Guest::where('reservation_number', $rno)->count();
		if($rn == 0){
			return "yes";
		}else{
			return "no";
		}
	}


	public function store()
	{
		//
		$inputs    = Input::all();
		$rmid      = $inputs['rmId'];
		$room      = Room::find($rmid);
		$arrival   = $room->checkin;
		$departure = $room->checkout;
		$dates     = Guest::generateDays($arrival, $departure);

		if($inputs['reservation_number'] == ""){
			$room->status = "occupied";
			$room->save();
			$reserved = "no";
		}else{
			$room->status = "reserved";
			$room->save();
			$reserved = "yes";
		}

		$guest     = Guest::create(array(
						"firstname"=>$inputs['fname'],
						"lastname"=>$inputs['lname'],
						"nationality"=>$inputs['nationality'],
						"address"=>$inputs['address'],
						"passport_number"=>$inputs['passport_number'],
						"country"=>$inputs['country'],
						"id_number"=>$inputs['id_number'],
						"professional"=>$inputs['professional'],
						"company"=>$inputs['company'],
						"telephone"=>$inputs['telephone'],
						"fax"=>$inputs['fax'],
						"job"=>$inputs['job'],
						"mobile"=>$inputs['mobile'],
						"email"=>$inputs['email'],
						"room_number"=>$rmid,
						"rate"=>$inputs['rate'],
						"adults"=>$inputs['adults'],
						"children"=>$inputs['children'],
						"arrival_date"=>$arrival,
						"departure_date"=>$departure,
						"discount"=>$inputs['discount'],
						"reservation_number"=>$inputs['reservation_number'],
						"mode"=>$inputs['mode'],
						"allegy"=>$inputs['allegy'],
						"reserved"=>$reserved
					));

		$gid  = $guest->id;

		foreach ($dates as $date) {
			$this->storeDay($date,$gid);	
		}	

			
	}

	public function storeDay($date, $gid){
		$log = HotelLogs::whereRaw('date = ? and guestid = ?', array($date, $gid))->count();
		if($log == 0){
			$lg  = HotelLogs::create(array(
						"guestid"=>$gid,
						"date"=>$date
				));
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
        return View::make('guests.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$g = Guest::find($id);
        return View::make('guests.edit', compact('g'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function messages(){
		return View::make('guests.messages');
	}

	public function update($id)
	{
		$inputs = Input::all();
		$g =  Guest::find($id);
		$g->firstname = $inputs['fname'];
		$g->lastname  = $inputs['lname'];
		$g->mobile    = $inputs['mobile'];
		$g->address   = $inputs['address'];
		$g->passport_number = $inputs['passport_number'];
		$g->country = $inputs['country'];
		$g->telephone = $inputs['telephone'];
		$g->id_number = $inputs['id_number'];
		$g->fax = $inputs['fax'];
		$g->job = $inputs['job'];
		$g->nationality = $inputs['nationality'];
		$g->email = $inputs['email'];
		$g->rate  = $inputs['rate'];
		$g->adults = $inputs['adults'];
		$g->children = $inputs['children'];
		$g->allegy   = $inputs['allegy'];
		//$g->reservation_number = $inputs['reservation_number'];
		$g->mode  = $inputs['mode'];
		$g->save();						
	}

	public function destroy($id)
	{
		//
	}
        function view_history($id){
             $data['id']=$id;
              return View::make('guests.details',$data);
                }
                function view_restaurant($id){
                    $data['viewID']=$id;
                    return View::make('guests.restDetails',$data);
                }
            }
        
        


