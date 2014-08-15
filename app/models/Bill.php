<?php

class Bill extends Eloquent {

	protected $table = "foodbills";

	protected $guarded = array();

	public static $rules = array();

	public static function tm($t){
		if($t == 1){
			return "Break fast";
		}else if($t == 2){
			return "Lunch";
		}else if($t == 3){
			return "Supper";
		}else if($t == 4){
			return "Dinner";
		}else if($t == 5){
			return "Neither";
		}
	}

	public static function getAlIncome($today){
			$foods = Bill::where('date', $today)->get();
			$TOT = 0;
			foreach($foods as $f){
				$foods  = explode("," , $f->foods);
				$fds    = array_pop($foods);
				$unique = array_keys(array_count_values($foods));
				$l      = count($unique);
				$total = 0;
				for($i=0; $i<$l; $i++){
					$total = $total + ((Bill::appears($unique[$i], $foods))*(Restaurant::where('name', $unique[$i])->first()->cost));
				}
				$TOT = $total + $TOT;
			}
			return $TOT;
	}

	public static function getIncome($today){
		$driks = Bill::where('date', $today)->get();
		$total = 0;
		foreach ($driks as $d) {
			$total = $d->amount + $total;
		}
		return $total;
	}

	public static function appears($f, $farry){

		$keys = array_keys($farry, $f);
		$n    = count($keys);
		
		return $n;

	}
}
