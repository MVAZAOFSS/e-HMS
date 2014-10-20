<?php
class GuestsController extends BaseController {


	public function __construct(){
		$this->beforeFilter('auth', array('*'));
	}
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
                $cost=$room->cost;

		$arrival       = $guest->arrival_date;
		$departure     = $guest->departure_date;
		
		$checkin       = $room->checkin;
                $room->totalcost=$cost*(substr($checkout,8,6)-  substr($checkin, 8,6));

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
        $rooms   = Room::where('status', '!=', 'occupied')->get();
        return View::make('guests.create', compact('rooms'));
	}
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
                $cost=$room->cost;
		$dates     = Guest::generateDays($arrival, $departure);

		if($inputs['reservation_number'] == ""){
			$room->status = "occupied";
                        $room->totalcost=$cost*(substr($departure,8,6)-  substr($arrival, 8,6));
			$room->save();
			$reserved = "no";
		}else{
			$room->status = "reserved";
                        $room->totalcost=$cost*(substr($departure,8,6)-  substr($arrival, 8,6));
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
                                                "totalcost"=>$cost*(substr($departure,8,6)-  substr($arrival, 8,6)),
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
    function customerLaundry($id){
       $data['id']=$id;
       return View::make('guests.viewLaundry',$data);
    }
    function customerEditLaundry($id){
       $data['id']=$id;
       $input=Input::all();
        $rules=array(
            'cost'=>'required|numeric'
        );
        $validator=Validator::make($input,$rules);
        if($validator->fails()){
          return View::make('guests.viewLaundry',$data)->withErrors($validator);
        }else{
           $cost = Glist::find($id)->totalprice;
           $remain = Glist::find($id)->remain;
           $gid=Glist::find($id)->gid;
           $remain2=Input::get('cost')+$remain;
           $data_array=array(
                'remain'=>$remain2
           );
            DB::table('laundrylist')->where('id',$id)->update($data_array);
             if($cost==$remain2){
                DB::table('laundrylist')->where('id',$id)->update(array('payment_mode'=>'paid'));
                DB::table('guests')->where('id',$gid)->update(array('llist'=>'yes'));
                 $data['sms']='<p class="alert alert-success">record updated</p>';
                 return View::make('guests.viewLaundry',$data);
            }else{
                DB::table('guests')->where('id',$gid)->update(array('llist'=>'no'));
                 $data['sms']='<p class="alert alert-success">record updated</p>';
                 return View::make('guests.viewLaundry',$data);
            }
        }
    }
    function view_customer($id){
        $data['id']=$id;
        return View::make('guests.view_customer',$data);
    }
        function view_history($id){
             $data['id']=$id;
              return View::make('guests.details',$data);
        }
        
       function view_restaurant($id){
        $data['viewID']=$id;
        return View::make('guests.restDetails',$data);
          
  }
        function cancel_id($id){
          $data['id']=$id;
          return View::make('guests.view_form',$data);
        }
        function cancel_edit_id($id){
          $data['id']=$id;
          $input=Input::all();
          $rules=array(
              'start'=>'required',
              'end'=>'required'
          );
          $validator=Validator::make($input,$rules);
          if($validator->fails()){
              return View::make('guests.view_form',$data)->withErrors($validator);
          }  else {
              $data_array=array(
                  'arrival_date'=>Input::get('start'),
                  'departure_date'=>Input::get('end')
              );
              $data_array2=array(
                  'checkin'=>Input::get('start'),
                  'checkout'=>Input::get('end')
              );
             DB::table('guests')->where('id',$id)->update($data_array);
             DB::table('rooms')->join('guests','guests.room_number','=','rooms.id')
                     ->where('guests.id',$id)->update($data_array2);
             $data['sms']='<p class="alert alert-success">Date squeezed</p>';
             return View::make('guests.view_form',$data);
             
          }
        }
        function cancel_danger($id){
            $idz=Guest::find($id)->room_number;
            $data_array=array(
                'checkin'=>'',
                'checkout'=>'',
                'status'=>'available',
                'totalcost'=>''
            );
            Room::find($idz)->update($data_array);
            DB::table('guests')->where('id',$id)
                     ->update(array('cancelled'=>'yes'));
          echo '<p class="alert alert-success">The order has been canceled</p>';  
        }
        function report_canceled(){
            $res=DB::table('guests')->where('cancelled','yes')->get();
            $data['order']=$res;
            return View::make('reports.canceled_order',$data);
        }
        function update_barbills($id){
            $data['id']=$id;
            $input=Input::all();
            $roles=array(
                'amount'=>'required|numeric'
            );
            $validator=Validator::make($input,$roles);
            if($validator->fails()){
                return View::make('guests.details',$data)->withError($validator);
            }  else {
                $remain= Bil::where('id',$id)->first();
                $cost=$remain->remain;
                $amount=Bil::find($id)->amount;
                if(Input::get('amount') < $cost){
                    $costz=$cost-Input::get('amount');
                    $table_up=array(
                    'amount'=>$amount+Input::get('amount'),
                    'remain'=>$costz 
                ); 
                DB::table('barbills')->where('id',$id)->update($table_up);
                $data['sms']='<p class="alert alert-success">Successifully updated</p>';
                return View::make('guests.details',$data);
                }  else {
                 $costz=$cost-Input::get('amount');
                    $table_up=array(
                    'amount'=>$amount+Input::get('amount'),
                    'remain'=>$costz, 
                    'cleared'=>'yes'
                ); 
                DB::table('barbills')->where('id',$id)->update($table_up);
                $data['sms']='<p class="alert alert-success">Successifully updated</p>';
                return View::make('guests.details',$data);
                }
            } 
            }
        function conferencesHome(){
            $data['ro']=$this->conferenceType();
            return View::make('guests.conferencesView',$data);
        }
       function conferencesSubmitAction(){
           $data['ro']=$this->conferenceType();
           $input=Input::all();
           $rules=array(
               'name'=>'required',
               'sec'=>'required',
               'amount'=>'required|numeric'
           );
           $validator=Validator::make($input,$rules);
           if($validator->fails()){
               return View::make('guests.conferencesView',$data)->withErrors($validator);
           }else{
           $data_array=array(
               'customerName'=>Input::get('name'),
               'type_conferes'=>Input::get('sec'),
               'amount'=>Input::get('amount'),
               'mode'=>Input::get('mode'),
               'remain'=>Input::get('remain'),
               'date'=>date('Y-m-d'),
               'status'=>'paid'
           );
               $data_array1=array(
                   'customerName'=>Input::get('name'),
                   'type_conferes'=>Input::get('sec'),
                   'amount'=>Input::get('amount'),
                   'mode'=>Input::get('mode'),
                   'remain'=>Input::get('remain'),
                   'date'=>date('Y-m-d'),
                   'status'=>'no'
               );
           $res=DB::table('conferes')->where('type_conferes',Input::get('sec'))->where('date',date('Y-m-d'))
               ->where('customerName',Input::get('name'))->get();
           if($res){
           if(Input::get('mode')=='Cash'){
               DB::table('conferes')->where('customerName',Input::get('name'))
                   ->where('date',date('Y-m-d'))->update($data_array);
               $data['sms']= "<p>Successifully upded</p>";
               return View::make('guests.conferencesView',$data);
           }elseif(Input::get('mode')=='Credit'){
               DB::table('conferes')->where('customerName',Input::get('name'))
                   ->where('date',date('Y-m-d'))->update($data_array1);
               $data['sms']= "<p>Successifully upded</p>";
               return View::make('guests.conferencesView',$data);
           }
           }else{
               if(Input::get('mode')=='Cash'){
               DB::table('conferes')->insert($data_array);
               $data['sms']= "<p>Successifully upded</p>";
               return View::make('guests.conferencesView',$data);
               }elseif(Input::get('mode')=='Credit'){
               DB::table('conferes')->insert($data_array1);
               $data['sms']= "<p>Successifully upded</p>";
               return View::make('guests.conferencesView',$data);
               }
           }
       }
       }
    function conferenceType(){
        $res=DB::table('conferes')->get();
        return $res;
    }
    function getTableContents($id){
         $data['id']=$id;
        return View::make('guests.tableBills',$data);
    }
    function payBillTableContents($id){
        $data['id']=$id;
        $input=Input::all();
        $rules=array(
            'pay'=>'required|numeric'
        );
        $validator=Validator::make($input,$rules);
        if($validator->fails()){
            return View::make('guests.tableBills',$data)->withErrors($validator);
        }else{
            $remain=Confere::where('id',$id)->first()->remain;
            $amount=Confere::where('id',$id)->first()->amount;
            if($remain > Input::get('pay')){
                $data_array=array(
                    'amount'=>Input::get('pay')+$amount,
                    'remain'=>$remain-Input::get('pay'),
                    'status'=>'no'
                );
              DB::table('conferes')->where('id',$id)->update($data_array);
              $data['sms']='<p class="alert alert-success"> Record updated</p>';
              return View::make('guests.tableBills',$data);
            }elseif($remain == Input::get('pay')){
                $data_array=array(
                    'amount'=>Input::get('pay')+$amount,
                    'remain'=>$remain-Input::get('pay'),
                    'status'=>'paid'
                );
                DB::table('conferes')->where('id',$id)->update($data_array);
                $data['sms']='<p class="alert alert-success"> Record updated</p>';
                return View::make('guests.tableBills',$data);
               }else{
                $data['sms']='<p class="alert alert-warning"> The amount paid is greater than amount to be paid</p>';
                return View::make('guests.tableBills',$data);
           }
        }
    }
}

        
        


