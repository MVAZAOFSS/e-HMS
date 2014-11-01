<?php
class BillsController extends BaseController {

	public function __construct(){
		$this->beforeFilter('auth', array('*'));
	}

	public function allsale(){
		return View::make('bills.allsales');
	}

	public function submitsale(){
		if(Auth::user()->role ==7){
			$inputs = Input::all();
			FoodSales::create(array(
				"food"=>$inputs['f'],
				"service"=>$inputs['t'],
				"date"=>date('Y-m-d'),
				"added_by"=>Auth::user()->id
			));

			$sales = FoodSales::whereRaw('date = ? and service = ?', array(date('Y-m-d'), $inputs['t']))->get();
			return View::make('bills.saleshow', compact('sales'));
                }elseif(Auth::user()->role ==8){
                    $inputs = Input::all();
			FoodSales::create(array(
				"food"=>$inputs['f'],
				"service"=>$inputs['t'],
				"date"=>date('Y-m-d'),
				"added_by"=>Auth::user()->id
			));

			$sales = FoodSales::whereRaw('date = ? and service = ?', array(date('Y-m-d'), $inputs['t']))->get();
			return View::make('bills.saleshow', compact('sales'));
		}else{
			$inputs = Input::all();
			DrinkSales::create(array(
				"drink"=>$inputs['d'],
				"service"=>$inputs['t'],
				"date"=>date('Y-m-d'),
				"added_by"=>Auth::user()->id,
                "no_drinks"=>$inputs['idadi']
			));

			$sales = DrinkSales::whereRaw('date = ? and service = ?', array(date('Y-m-d'), $inputs['t']))->get();
			return View::make('bills.saleshow', compact('sales'));
		}
	}

	public function sales(){
		return View::make('bills.sales');
	}

	public function all(){
		return View::make('bills.all');
	}

	public function index()
	{
        return View::make('bills.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('bills.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::user()->role == 7){
				$inputs   = Input::all();
				$mode     = $inputs['c'];
				$guestid  = $inputs['gid'];
				$amount   = $inputs['a'];
				$stime    = $inputs['s'];
				$total    = $inputs['t'];

				$gbill    = Bill::whereRaw('guestid = ? and servicetime = ? and date = ?', array($guestid, $stime, date('Y-m-d')))->first();

				if($mode == "cash"){


				if($amount > $total){
						return "no";
					}else{
				            $gbill->paymentmode = $mode;
					    $gbill->amount      = $amount;
					    $gbill->remain = (double)($total - $amount);
                                            $gbill->cleared='yes';
					    $gbill->save();
						return "ok";
					}

				}else{
					$gbill->paymentmode = $mode;
					$gbill->save();
					return "ok";
				}
		}elseif (Auth::user()->role == 8) {
                         $inputs   = Input::all();
				$mode     = $inputs['c'];
				$guestid  = $inputs['gid'];
				$amount   = $inputs['a'];
				$stime    = $inputs['s'];
				$total    = $inputs['t'];

				$gbill    = Bill::whereRaw('guestid = ? and servicetime = ? and date = ?', array($guestid, $stime, date('Y-m-d')))->first();

				if($mode == "cash"){


				if($amount > $total){
						return "no";
					}else{
				            $gbill->paymentmode = $mode;
					    $gbill->amount      = $amount;
					    $gbill->remain = (double)($total - $amount);
                                            $gbill->cleared='yes';
					    $gbill->save();
						return "ok";
					}

				}else{
					$gbill->paymentmode = $mode;
					$gbill->save();
					return "ok";
				}
                       }else{
				$inputs   = Input::all();
				$mode     = $inputs['c'];
				$guestid  = $inputs['gid'];
				$amount   = $inputs['a'];
				$stime    = $inputs['s'];
				$total    = $inputs['t'];

				$gbill    = Bil::whereRaw('guestid = ? and servicetime = ? and date = ?', array($guestid, $stime, date('Y-m-d')))->first();

				if($mode == "cash"){



					if($amount > $total){
						return "no";
					}else{
						$gbill->paymentmode = $mode;
					    $gbill->amount      = $amount;
					    $gbill->remain = (double)($total - $amount);
                                            $gbill->cleared='yes';
					    $gbill->save();
						return "ok";
					}

				}else{
					$gbill->paymentmode = $mode;
					$gbill->save();
					return "ok";
				}			
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
        return View::make('bills.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('bills.edit');
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

	public function loadbill(){
			$bid = Input::get('id');
			if(Auth::user()->role == 7){
				$bi = 	Bill::find($bid);
                        }elseif(Auth::user()->role == 8){
                            $bi = 	Bill::find($bid);
			}else{
				$bi = 	Bil::find($bid);
			}
			
			return View::make('bills.create', compact('bi'));
	}

	public function servicetime(){
		
		if(Auth::user()->role == 7){
			$s   = Input::get('s');
			$id  = Input::get('g');

			if($s != "all"){
				$bn = Bill::whereRaw('guestid=? and servicetime = ?', array($id, $s))->count();
				if($bn == 0){
					return View::make('bills.create')->with('error', 'No result found ')->with('stime', Bill::tm($s))->with('g', $id);
				}else{
					$bi = Bill::whereRaw('guestid=? and servicetime = ?', array($id, $s))->first();
					return View::make('bills.create', compact('bi'));
				}	
			}else{
				$bi = Bill::whereRaw('guestid=?', array($id))->get();
				return View::make('bills.history', compact('bi'));
			}
                }elseif(Auth::user()->role ==8){
                    $s   = Input::get('s');
			$id  = Input::get('g');

			if($s != "all"){
				$bn = Bill::whereRaw('guestid=? and servicetime = ?', array($id, $s))->count();
				if($bn == 0){
					return View::make('bills.create')->with('error', 'No result found ')->with('stime', Bill::tm($s))->with('g', $id);
				}else{
					$bi = Bill::whereRaw('guestid=? and servicetime = ?', array($id, $s))->first();
					return View::make('bills.create', compact('bi'));
				}	
			}else{
				$bi = Bill::whereRaw('guestid=?', array($id))->get();
				return View::make('bills.history', compact('bi'));
			}
		}else{
			$s   = Input::get('s');
			$id  = Input::get('g');

			if($s != "all"){
				$bn = Bil::whereRaw('guestid=? and servicetime = ?', array($id, $s))->count();
				if($bn == 0){
					return View::make('bills.create')->with('error', 'No result found ')->with('stime', Bill::tm($s))->with('g', $id);
				}else{
					$bi = Bil::whereRaw('guestid=? and servicetime = ?', array($id, $s))->first();
					return View::make('bills.create', compact('bi'));
				}	
			}else{
				$bi = Bil::whereRaw('guestid=?', array($id))->get();
				return View::make('bills.history', compact('bi'));
			}			
		}
		
	}

	public function updatebill(){
		if(Auth::user()->role == 8){
				$id     	  = Input::get('g');
				$amount  	  = Input::get('a');
				$total   	  = Input::get('t');
				$stime   	  = Input::get('s');

				$bill   	  = Bill::find($id);
				$amo          = $bill->amount;
				$newamount    = $amount + $amo;

				if($total < $newamount){
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));

				}else if($total==$newamount){
                                        $bill->amount = $newamount;
                                        $bill->cleared='yes';
                                        $bill->remain = (double)($total - $newamount);
					$bill->save();
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));
                                }else{
                                    $bill->amount = $newamount;
                                    $bill->remain = (double)($total - $newamount);
                                    $bill->save();
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));
                                }
		}elseif (Auth::user()->role == 7) {
                 $id     	  = Input::get('g');
				$amount  	  = Input::get('a');
				$total   	  = Input::get('t');
				$stime   	  = Input::get('s');

				$bill   	  = Bill::find($id);
				$amo          = $bill->amount;
				$newamount    = $amount + $amo;

				if($total < $newamount){
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));

				}else if($total==$newamount){
                                        $bill->amount = $newamount;
                                        $bill->cleared='yes';
                                        $bill->remain = (double)($total - $newamount);
					$bill->save();
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));
                                }else{
                                    $bill->amount = $newamount;
                                    $bill->remain = (double)($total - $newamount);
                                    $bill->save();
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));
                                }
              }
                else{
				$id     	  = Input::get('g');
				$amount  	  = Input::get('a');
				$total   	  = Input::get('t');
				$stime   	  = Input::get('s');

				$bill   	  = Bil::find($id);
				$amo          = $bill->amount;
				$newamount    = $amount + $amo;

				if($total < $newamount){
					$bi           = Bil::find($id);
					return View::make('bills.create', compact('bi'));

				}else if($total==$newamount){
                                        $bill->amount = $newamount;
                                        $bill->cleared='yes';
                                        $bill->remain = (double)($total - $newamount);
					$bill->save();
					$bi           = Bill::find($id);
					return View::make('bills.create', compact('bi'));
                                }else{

					$bill->amount = $newamount;
					$bill->remain = (double)($total - $newamount);
					$bill->save();
					$bi           = Bil::find($id);
					return View::make('bills.create', compact('bi'));
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
	}

	public function submit(){
		$inputs  = Input::all();
		
		if(Auth::user()->role == 7){
                $g       = $inputs['g'];
				$f       = $inputs['f'];
				$t       = $inputs['t'];
			     $cost=Restaurant::where('name',$f)->first()->cost;
				
                                $food    = $f . ",";
                            
				$start   = strpos($g, "(") + 1;
				$end     = -1;	
				$room    = substr($g, $start, $end);
				
				$roomid  = Room::where('name', $room)->first()->id;
				$guest   = Guest::whereRaw('room_number = ? and checked = "no" and released ="no" and cancelled="no" ', array($roomid))->first();
				
				$gid     = $guest->id;
				
				$b       = Bill::whereRaw('guestid=? and servicetime=? and date = ?', array($gid, $t, date('Y-m-d')))->count();
				
				$lg      = Auth::user()->id;

				if($b == 0){

					$bill    = Bill::create(array(
                                        "guestid"=>$gid,
                                        "foods"=>$food,
                                        "servicetime"=>$t,
                                        "added_by"=>$lg,
                                        "date"=>date('Y-m-d'),
                                        "remain"=>$cost
				 )); 
					

				}else{

					$bil        = Bill::whereRaw('guestid=? and servicetime=? and date =? ', array($gid, $t, date('Y-m-d')))->first();
					$foods      = $bil->foods;
					$newfoods   = $foods . $food ;
					$bil->foods = $newfoods;
                                        $bil->remain=$bil->remain+$cost;
					$bil->save();

					

				}

				$bi = Bill::whereRaw('guestid=? and servicetime=?', array($gid, $t))->first();

				return View::make('bills.show', compact('bi'));
                                

		}elseif (Auth::user()->role == 8) {
                                $g       = $inputs['g'];
				$f       = $inputs['f'];
				$t       = $inputs['t'];
			     $cost=Restaurant::where('name',$f)->first()->cost;
				
                                $food    = $f . ",";
                            
				$start   = strpos($g, "(") + 1;
				$end     = -1;	
				$room    = substr($g, $start, $end);
				
				$roomid  = Room::where('name', $room)->first()->id;
				$guest   = Guest::whereRaw('room_number = ? and checked = "no" ', array($roomid))->first();
				
				$gid     = $guest->id;
				
				$b       = Bill::whereRaw('guestid=? and servicetime=? and date = ?', array($gid, $t, date('Y-m-d')))->count();
				
				$lg      = Auth::user()->id;

				if($b == 0){

					$bill    = Bill::create(array(
                                        "guestid"=>$gid,
                                        "foods"=>$food,
                                        "servicetime"=>$t,
                                        "added_by"=>$lg,
                                        "date"=>date('Y-m-d'),
                                        "remain"=>$cost
				 )); 
					

				}else{

					$bil        = Bill::whereRaw('guestid=? and servicetime=? and date =? ', array($gid, $t, date('Y-m-d')))->first();
					$foods      = $bil->foods;
					$newfoods   = $foods . $food ;
					$bil->foods = $newfoods;
                                        $bil->remain=$bil->remain+$cost;
					$bil->save();

					

				}

				$bi = Bill::whereRaw('guestid=? and servicetime=?', array($gid, $t))->first();

				return View::make('bills.show', compact('bi'));


                }else{

				$g       = $inputs['g'];
				$d       = $inputs['d'];
				$t       = $inputs['t'];
                $idadi=  $inputs['idadi'];
				$cost= Bar::where('name',$d)->first()->cost;
				$drink    = $d . ",";

				$start   = strpos($g, "(") + 1;
				$end     = -1;	
				$room    = substr($g, $start, $end);
				
				$roomid  = Room::where('name', $room)->first()->id;
				$guest   = Guest::whereRaw('room_number = ? and checked = "no" and released ="no" and cancelled="no" ', array($roomid))->first();
				
				$gid     = $guest->id;
				
				$b       = Bil::whereRaw('guestid=? and servicetime=? and date = ?', array($gid, $t, date('Y-m-d')))->count();
				
				$lg      = Auth::user()->id;

				if($b == 0){

					$bill    = Bil::create(array(
										"guestid"=>$gid,
										"drinks"=>$drink,
										"servicetime"=>$t,
										"added_by"=>$lg,
										"date"=>date('Y-m-d'),
                                        "remain"=>$cost,
                                        "no_drinks"=>$idadi
							   )); 
					

				}else{

					$bil        = Bil::whereRaw('guestid=? and servicetime=? and date =? ', array($gid, $t, date('Y-m-d')))->first();
					$drinks      = $bil->drinks;
                    $idadis      =$bil->no_drinks;
					$newdrinks   = $drinks . $drink ;
					$bil->drinks = $newdrinks;
                    $bil->no_drinks =$idadis+$idadi;
                    $bil->remain=  $bil->remain+$cost;
					$bil->save();

					

				}

				$bi = Bil::whereRaw('guestid=? and servicetime=?', array($gid, $t))->first();

				return View::make('bills.show', compact('bi'));			

		}
	}	
        function billsprint($id){
           $res=DB::table('foodbills')->where('id',$id)->get();
           $pdf = PDF::loadView('bills.print_view',compact('res'));
           return $pdf->stream();
        }
        function sellsprint($id){
            $res=DB::table('foodsales')
                    ->join('restaurants','restaurants.name','=','foodsales.food')
                    ->where('foodsales.id',$id)->get();
            $pdf=PDF::loadView('bills.print_sells',  compact('res'));
            return $pdf->stream();
        }
        function billsprintbar($id){
           $res=DB::table('barbills')->where('id',$id)->get();
           $pdf = PDF::loadView('bills.print_viewbar',compact('res'));
           return $pdf->stream();
        }
        function sellsprintbarz($id){
            $res=DB::table('drinksales')
                    ->join('bars','bars.name','=','drinksales.drink')
                    ->where('drinksales.id',$id)->get();
            $pdf=PDF::loadView('bills.print_sellsbarz',  compact('res'));
            return $pdf->stream();
        }
}
