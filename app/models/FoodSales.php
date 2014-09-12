<?php


class FoodSales extends Eloquent{
	
	protected $table = "foodsales";

	public $timestamps = "false";

	protected $guarded = array();

	public static function getIncome($today){
		$driks = FoodSales::where('date', $today)->get();
		$total = 0;
		foreach ($driks as $d) {
			$dname = $d->drink;
			$cost  = Bill::where('name', $dname)->first()->cost;
			$total = $cost + $total;
		}
		return $total;
	}

}