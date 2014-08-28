<?php
class Bil extends Eloquent{
	
	protected $table = "barbills";

	protected $guarded = array();

	public static $rules = array();

	public static function getIncome($today){
		$driks = Bil::where('date', $today)->get();
		$total = 0;
		foreach ($driks as $d) {
			$total = $d->amount + $total;
		}
		return $total;
	}

	public static function getAlIncome($today){
			$foods = Bil::where('date', $today)->get();
			$TOT = 0;
			foreach($foods as $f){
				$foods  = explode("," , $f->drinks);
				$fds    = array_pop($foods);
				$unique = array_keys(array_count_values($foods));
				$l      = count($unique);
				$total = 0;
				for($i=0; $i<$l; $i++){
					$total = $total + ((Bil::appears($unique[$i], $foods))*(Bar::where('name', $unique[$i])->first()->cost));
				}
				$TOT = $total + $TOT;
			}
			return $TOT;
	}
}