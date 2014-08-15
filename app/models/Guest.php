<?php

class Guest extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function checkBar($gid){
		$bill  = Bil::whereRaw('guestid = ? and cleared = "yes"', array($gid))->count();
		return $bill;
	}

	public static function checkRest($gid){
		$bill  = Bill::whereRaw('guestid = ? and cleared = "yes"', array($gid))->count();
		return $bill;
	}

	public static function daysSpent($ar, $dep){
			$ar_time  = strtotime($ar);
			$dep_time = strtotime($dep); 
			$datediff = $dep_time - $ar_time;
     		$days     = floor($datediff/(60*60*24));
     		return $days;
	}

	public static function generateDays($ar, $dep){
			$ar_time  = strtotime($ar);
			$dep_time = strtotime($dep);
			$dates    = array();
			$dates[]  = $ar; 
			$datediff = $dep_time - $ar_time;
     		$days     = floor($datediff/(60*60*24));
     		for($i=1; $i<=$days; $i++){
     			$ar_time   = $ar_time + (60*60*24);
     			$next_date = date('Y-m-d', $ar_time);
     			$dates[]   = $next_date;
     		}

     		return $dates;
	}

	public static function generateGuestsNoIncome($ar, $dep){
			$ar_time  = strtotime($ar);
			$dep_time = strtotime($dep);
			$dates    = array();
			$dates[]  = $ar; 
			$datediff = $dep_time - $ar_time;
     		$days     = floor($datediff/(60*60*24));
     		for($i=1; $i<=$days; $i++){
     			$ar_time   = $ar_time + (60*60*24);
     			$next_date = date('Y-m-d', $ar_time);
     			$dates[]   = $next_date;
     		}
     		$guests   = array();
     		$total    = 0;
     		foreach ($dates as $date) {
     					# code...
     			$reports  = HotelLogs::where('date', $date)->get();
     			foreach($reports as $m){
					$total = (double)$total + Room::find(Guest::find($m->guestid)->room_number)->cost;	    
				}
     			$guests[] = $total;
     		}

     		return $guests;		
	}



	public static function generateGuestsNo($ar, $dep){
			$ar_time  = strtotime($ar);
			$dep_time = strtotime($dep);
			$dates    = array();
			$dates[]  = $ar; 
			$datediff = $dep_time - $ar_time;
     		$days     = floor($datediff/(60*60*24));
     		for($i=1; $i<=$days; $i++){
     			$ar_time   = $ar_time + (60*60*24);
     			$next_date = date('Y-m-d', $ar_time);
     			$dates[]   = $next_date;
     		}
     		$guests   = array();
     		foreach ($dates as $date) {
     					# code...
     			$n  = HotelLogs::where('date', $date)->count();
     			$guests[] = $n;
     		}

     		return $guests;		
	}

	public static function guestsRIIncome($ar, $dep, $ri){
			$ar_time  = strtotime($ar);
			$dep_time = strtotime($dep);
			$dates    = array();
			$dates[]  = $ar; 
			$datediff = $dep_time - $ar_time;
     		$days     = floor($datediff/(60*60*24));
     		for($i=1; $i<=$days; $i++){
     			$ar_time   = $ar_time + (60*60*24);
     			$next_date = date('Y-m-d', $ar_time);
     			$dates[]   = $next_date;
     		}
     		$guests   = array();
     		$pn       = 0;
     		$rn       = 0;
     		foreach ($dates as $date) {
     					# code...
     			
     			$reports  = HotelLogs::where('date', $date)->get();
     			if($ri == "paid"){
     				foreach($reports as $m){
					    if(Guest::find($m->guestid)->checked == "yes"){
					    	$pn = $pn + Room::find(Guest::find($m->guestid))->cost;
					    }
					}
					$guests[] = $pn;

     			}else if($ri == "reserved"){
     				foreach($reports as $m){
					    if(Guest::find($m->guestid)->reservation_number != ""){
					    	$rn = $rn + Room::find(Guest::find($m->guestid))->cost;
					    }
					}
					$guests[] = $rn;
     			}
     			
				   
     			
     		}

     		return $guests;	
	}


	public static function guestsRI($ar, $dep, $ri){
			$ar_time  = strtotime($ar);
			$dep_time = strtotime($dep);
			$dates    = array();
			$dates[]  = $ar; 
			$datediff = $dep_time - $ar_time;
     		$days     = floor($datediff/(60*60*24));
     		for($i=1; $i<=$days; $i++){
     			$ar_time   = $ar_time + (60*60*24);
     			$next_date = date('Y-m-d', $ar_time);
     			$dates[]   = $next_date;
     		}
     		$guests   = array();
     		$pn       = 0;
     		$rn       = 0;
     		foreach ($dates as $date) {
     					# code...
     			
     			$reports  = HotelLogs::where('date', $date)->get();
     			if($ri == "paid"){
     				foreach($reports as $m){
					    if(Guest::find($m->guestid)->checked == "yes"){
					    	$pn = $pn + 1;
					    }
					}
					$guests[] = $pn;

     			}else if($ri == "reserved"){
     				foreach($reports as $m){
					    if(Guest::find($m->guestid)->reservation_number != ""){
					    	$rn = $rn + 1;
					    }
					}
					$guests[] = $rn;
     			}
     			
				   
     			
     		}

     		return $guests;	
	}

	public static function getMonth($m){
		if($m=="january"){
			return "01";
		}elseif($m=="february"){
			return "02";
		}elseif($m=="march"){
			return "03";
		}elseif($m=="april"){
			return "04";
		}elseif($m=="may"){
			return "05";
		}elseif($m=="june"){
			return "06";
		}elseif($m=="july"){
			return "07";
		}elseif($m=="august"){
			return "08";
		}elseif($m=="september"){
			return "09";
		}elseif($m=="october"){
			return "10";
		}elseif($m=="november"){
			return "11";
		}elseif($m=="december"){
			return "12";
		}
	}

	public static function getNextMonth($m){
		if($m=="january"){
			return "02";
		}elseif($m=="february"){
			return "03";
		}elseif($m=="march"){
			return "04";
		}elseif($m=="april"){
			return "05";
		}elseif($m=="may"){
			return "06";
		}elseif($m=="june"){
			return "07";
		}elseif($m=="july"){
			return "08";
		}elseif($m=="august"){
			return "09";
		}elseif($m=="september"){
			return "10";
		}elseif($m=="october"){
			return "11";
		}elseif($m=="november"){
			return "12";
		}elseif($m=="december"){
			return "01";
		}
	}

}
