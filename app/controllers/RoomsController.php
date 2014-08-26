<?php

class RoomsController extends BaseController {
      public function __construct(){
                $this->beforeFilter('auth', array('*'));
        }

        public function repair(){
                return View::make('rooms.repair');
        }

        public function repairs(){
                return View::make('rooms.repairs');
        }

        public function postrepair(){
                $inputs = Input::all();
                $rname  = $inputs['name'];
                $room   = Room::where('name', $rname)->count();
                if($room == 0){
                        return View::make('rooms.repair')->with('emsg', 'Room  ' . $rname . ' does not exists in the system');
                }else{
                        $rn  =  Room::where('name', $rname)->first()->id;
                        $nit = Guest::find($rn)->id;
                        $nt = Notification::create(array(
                                        "nfrom" => "room controller",
                                        "to"=>"secretary",
                                        "title"=>$inputs['problem'],
                                        "body"=>$inputs['body'],
                                        "ntype"=>"room repair",
                                        "nid"=>$nit
                                ));
                        $nt = Notification::create(array(
                                        "nfrom" => "room controller",
                                        "to"=>"manager",
                                        "title"=>$inputs['problem'],
                                        "body"=>$inputs['body'],
                                        "ntype"=>"room repair",
                                        "nid"=>$nit
                                ));



                        return View::make('rooms.repair')->with('msg', 'Room  ' . $rname . ' was reported successfully');
                }
        }

        public function addday(){
                $inputs   = Input::all();
                $rn       = $inputs['r'];
                $g        = Guest::find($rn)->room_number;
                $nit      = Guest::find($rn)->id;
                $room     = Room::find($g);
                $name     = $room->name;
                $checkin  = $room->checkin;
                $checkout = $room->checkout;
                $days     = $inputs['d'];

                $n    = Notification::create(array(
                                        "nfrom"   => "room controller",
                                        "to"     => "secretary",
                                        "nid"=>$nit,
                                        "ntype"   => "add days",
                                        "title"  => $days." days",
                                        "body"   => "Room number: " . $name . " arrival date: (" . $checkin . ") departure date: (" . $checkout . ") request to add " . $days . " days ",
                        ));
        }

        public function postrequests($id){
                $nt = 	Notification::find($id);
                $nt->removed = 'yes';
                $nt->save();
        }

        public function index()
        {
                $rooms = Room::all();
        return View::make('rooms.index', compact('rooms'));
        }

        public function showrelease(){
                return View::make('rooms.release');
        }

        public function showrequests(){
                return View::make('rooms.requests');
        }

        public function release($id){
                $g     = Guest::find($id);
                $rmn   = $g->room_number;
                $room  = Room::find($rmn);
                $room->status   = "available";
                $room->checkin  = "0000-00-00";
                $room->checkout = "0000-00-00";
                $g->released    = "yes";
                $g->save();
                $room->save();
                $n = Guest::whereRaw('departure_date = ? and released = ?', array(date("Y-m-d"), 'no'))->count();
                return ($n);

        }

        public function roomcheck(){
                $inputs      = Input::all();
                $checkin     = $inputs['checkin'];

                $chk_time    = strtotime($checkin);
                $today       = time();

                if($today < $chk_time){
                        $rs = "ndio";
                }else{
                        $rs = "sio";
                }

                $checkout    = $inputs['checkout'];
                $rid         = $inputs['room'];
                $room        = Room::find($rid);
                $status      = $room->status;
                $db_checkin  = $room->checkin;
                $db_checkout = $room->checkout;
                if($status == "available"){
                        if($db_checkin=="0000-00-00"&&$db_checkout=="0000-00-00"){
                                $room->checkin  = $checkin;
                                $room->checkout = $checkout;
                                //$room->status   = "occupied";
                                $room->save();
                                $dt      = array('msg'=>'available', 'room'=> $room->name, 'checkout'=>$db_checkout, "res"=>$rs);
                            return   json_encode($dt);
                        }else{
                                $room->checkin  = $checkin;
                                $room->checkout = $checkout;
                                //$room->status   = "occupied";
                                $room->save();
                                $dt      = array('msg'=>'available', 'room'=> $room->name, 'checkout'=>$db_checkout, "res"=>$rs);
                            return   json_encode($dt);
                        }

                }else if($status == "reserved"){
                        $chk = Room::whereRaw('id=? and checkin>?', array($rid,$checkout))->count();
                        if($chk == 0){
                                $room->checkin  = $checkin;
                                $room->checkout = $checkout;
                                //$room->status   = "occupied";
                                $room->save();
                                $dt      = array('msg'=>'ereserved', 'room'=> $room->name, 'checkin'=>$db_checkin, "res"=>$rs);
                                return   json_encode($dt);
                        }else{
                                $room->checkin  = $checkin;
                                $room->checkout = $checkout;
                                //$room->status   = "occupied";
                                $room->save();
                                $dt      = array('msg'=>'reserved', 'room'=> $room->name, 'checkin'=>$db_checkin, "res"=>$rs);
                                return   json_encode($dt);
                        }

                }else{
                        $room->checkin  = $checkin;
                        $room->checkout = $checkout;
                        //$room->status   = "occupied";
                        $room->save();
                        $dt      = array('msg'=>'occupied', 'room'=> $room->name, 'checkout'=>$db_checkout);
                        return   json_encode($dt);
                }

        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
        return View::make('rooms.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function store()
        {	
                $inputs = Input::all();
                $room = Room::where('name', $inputs['name'])->count();
                if($room == 0){

                        $r = Room::create($inputs);
                        return View::make('rooms.create')->with('msg', 'Successfully, added ');
                }else{
                        return View::make('rooms.create')->with('emsg', 'Room exists! please choose another');
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
        return View::make('rooms.show');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function edit($id)
        {
                $room = Room::find($id);
        return View::make('rooms.edit', compact('room'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function update($id)
        {
                $room = Room::find($id);
                $inputs = Input::all();
                $name = $room->name;
                if($name != $inputs['name']){
                        $r = Room::where('name', $inputs['name'])->count();
                        if($r==0){
                                $room->name = $inputs['name'];
                                $room->cost = $inputs['cost'];
                                $room->save();
                                return View::make('rooms.edit', compact('room'))->with('msg', 'Successfully updated');
                        }else{
                                return View::make('rooms.edit', compact('room'))->with('emsg', 'Room exists');
                        }
                }else{
                        $room->name =$inputs['name'];
                        $room->cost = $inputs['cost'];
                        $room->save();
                        return View::make('rooms.edit', compact('room'))->with('msg', 'Successfully updated');
                }

        }
     public function destroy($id)
        {
                $room = Room::find($id);
                $room->delete();
        }
        function report_display($guest,$all_type,$date){
               if($guest=='Guest'&& $all_type=='all'){
              $res=DB::table('rooms')->select('*')
                      ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('cancelled','no')
                      ->where('rooms.created_at','LIKE','%'.$date.'%')
                      ->get();
               $data['git']=$res;
               return View::make('rooms.roomreport',$data);
            }elseif ($guest=='Guest'&& $all_type=='reserved') {
            $res=DB::table('rooms')->select('*')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('status','reserved')
                    ->where('cancelled','no')
                    ->where('rooms.created_at','LIKE','%'.$date.'%')
                    ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='Guest' && $all_type=='paid') {
            $res=DB::table('rooms')->select('*')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('status','occupied')
                   ->where('cancelled','no')
                   ->where('rooms.created_at','LIKE','%'.$date.'%')
                    ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='income' && $all_type=='all') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                    ->where('cancelled','no')
                   ->where('rooms.created_at','LIKE','%'.$date.'%')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
            
        }elseif ($guest=='income'&& $all_type=='reserved') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','LIKE','%'.$date.'%')
                    ->where('status','reserved')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }elseif ($guest=='income'&& $all_type=='paid') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','LIKE','%'.$date.'%')
                    ->where('status','occupied')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
            
        }
            
        }
        function report_weekly_display($guest,$all_type,$start_date,$end_date){
            if($guest=='Guest'&& $all_type=='all'){
              $res=DB::table('rooms')->select('*')
                      ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->whereBetween('checkin',array($start_date,$end_date))
                      ->where('cancelled','no')
                      ->get();
               $data['git']=$res;
               return View::make('rooms.roomreport',$data);
            }elseif ($guest=='Guest'&& $all_type=='reserved') {
            $res=DB::table('rooms')->select('*')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('status','reserved')
                   ->whereBetween('checkin',array($start_date,$end_date))
                    ->where('cancelled','no')
                    ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='Guest' && $all_type=='paid') {
            $res=DB::table('rooms')->select('*')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('status','occupied')
                    ->whereBetween('checkin',array($start_date,$end_date))
                    ->where('cancelled','no')
                    ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='income' && $all_type=='all') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->whereBetween('checkin',array($start_date,$end_date))
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->ctotalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
            
        }elseif ($guest=='income'&& $all_type=='reserved') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->whereBetween('checkin',array($start_date,$end_date))
                    ->where('status','reserved')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }elseif ($guest=='income'&& $all_type=='paid') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->whereBetween('checkin',array($start_date,$end_date))
                    ->where('status','occupied')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }
        }
        function report_monthly_display($guest,$all_type,$year ,$month){
            if($guest=='Guest'&& $all_type=='all'){
              $res=DB::table('rooms')->select('*')
                      ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('rooms.created_at','like','%'.$month.'%')
                      ->where('rooms.created_at','LIKE','%'.$year.'%')
                      ->where('cancelled','no')
                      ->get();
               $data['git']=$res;
               return View::make('rooms.roomreport',$data);
            }elseif ($guest=='Guest'&& $all_type=='reserved') {
            $res=DB::table('rooms')->select('*')
                      ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('rooms.created_at','like','%'.$month.'%')
                      ->where('rooms.created_at','LIKE','%'.$year.'%')
                      ->where('status','reserved')
                    ->where('cancelled','no')
                      ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='Guest' && $all_type=='paid') {
            $res=DB::table('rooms')->select('*')
                     ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('rooms.created_at','like','%'.$month.'%')
                      ->where('rooms.created_at','LIKE','%'.$year.'%')
                      ->where('status','occupied')
                    ->where('cancelled','no')
                      ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='income' && $all_type=='all') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','like','%'.$month.'%')
                   ->where('rooms.created_at','LIKE','%'.$year.'%')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
            
        }elseif ($guest=='income'&& $all_type=='reserved') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','like','%'.$month.'%')
                   ->where('rooms.created_at','LIKE','%'.$year.'%')
                   ->where('status','reserved')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }elseif ($guest=='income'&& $all_type=='paid') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','like','%'.$month.'%')
                   ->where('rooms.created_at','LIKE','%'.$year.'%')
                    ->where('status','occupied')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }
        }
        function report_year_display($guest,$all_type,$year){
            if($guest=='Guest'&& $all_type=='all'){
              $res=DB::table('rooms')->select('*')
                      ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('rooms.created_at','LIKE','%'.$year.'%')
                      ->where('cancelled','no')
                      ->get();
               $data['git']=$res;
               return View::make('rooms.roomreport',$data);
            }elseif ($guest=='Guest'&& $all_type=='reserved') {
            $res=DB::table('rooms')->select('*')
                      ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('rooms.created_at','LIKE','%'.$year.'%')
                      ->where('status','reserved')
                    ->where('cancelled','no')
                      ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='Guest' && $all_type=='paid') {
            $res=DB::table('rooms')->select('*')
                     ->join('guests','guests.room_number', '=' ,'rooms.id')
                      ->where('rooms.created_at','LIKE','%'.$year.'%')
                      ->where('status','occupied')
                    ->where('cancelled','no')
                      ->get();
            $data['git']=$res;
            return View::make('rooms.roomreport',$data);
        }elseif ($guest=='income' && $all_type=='all') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','LIKE','%'.$year.'%')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }elseif ($guest=='income'&& $all_type=='reserved') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                   ->where('rooms.created_at','LIKE','%'.$year.'%')
                   ->where('status','reserved')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }elseif ($guest=='income'&& $all_type=='paid') {
            $res=DB::table('rooms')
                   ->join('guests','guests.room_number', '=' ,'rooms.id')
                    ->where('rooms.created_at','LIKE','%'.$year.'%')
                    ->where('status','occupied')
                    ->where('cancelled','no')
                   ->get(array(
                        '*',
                        DB::raw('SUM(rooms.totalcost) AS totalcost')
                    ));
            foreach ($res as $money){
                if($money->mode=='Cash'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                         'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);   
                }
                elseif($money->mode =='Credit'){
                    $cash=array(
                        'cashcost'=>$money->totalcost,
                        'cashmode'=>$money->mode
                    );
                    return View::make('rooms.roomreportcost',$cash);
                }
            }
            $cash=array(
                        'cashcost'=>'No Money',
                         'cashmode'=>''
                    );
                    return View::make('rooms.roomreportcost',$cash);
        }
        }
}
