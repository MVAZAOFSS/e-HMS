<?php


class Llist extends Eloquent{
	protected $table = "laundrylists";

	protected $guarded = array();

	public static function getIncome($today){
		$logs = HotelLogs::where('date', $today)->get();
		$total = 0;
		foreach ($logs as $log) {
			$prc = Llist::getTot($log->guestid);
			$total = $prc + $total;
		}
		return $total;
	}

	public static function getTot($gid){

		$c = Llist::where('gid', $gid)->count();

		if($c == 0){
			return 0;
		}else{
			$a       = 1;
			$laundry = Laundrie::all();
			$items   = array();
			foreach($laundry as $l){
				$items[] = $l->name;
			}

			$ls = array_keys(array_count_values($items));
			$s  = count($ls);

			$lauTC = 0;
			$dryTC = 0;
			$preTC = 0;

			for($i=0;$i<$s; $i++){
				$lauTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 1))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost) + $lauTC;
				$dryTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 2))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost)  + $dryTC;
				$preTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 3))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost) + $preTC;
			}

			$totCost = $lauTC + $preTC + $dryTC;  
		
			return $totCost;
		} 
	}

	public static function getRemain($gid){

		$c = Llist::where('gid', $gid)->count();

		if($c == 0){
			return 0;
		}else{
			$a       = 1;
			$laundry = Laundrie::all();
			$items   = array();
			foreach($laundry as $l){
				$items[] = $l->name;
			}

			$ls = array_keys(array_count_values($items));
			$s  = count($ls);

			$lauTC = 0;
			$dryTC = 0;
			$preTC = 0;

			for($i=0;$i<$s; $i++){
				$lauTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 1))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(1, $ls[$i]))->first()->cost) + $lauTC;
				$dryTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 2))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(2, $ls[$i]))->first()->cost)  + $dryTC;
				$preTC = (Llist::whereRaw('gid = ? and counttype = ? and category = ?', array($gid, 'g', 3))->first()->cvalue  * Laundrie::whereRaw('category = ? and name = ?', array(3, $ls[$i]))->first()->cost) + $preTC;
			}

			$totCost = $lauTC + $preTC + $dryTC;  
			$remain  = $totCost- Glist::find($gid)->totalprice;

			return $remain;
		} 
	}

}