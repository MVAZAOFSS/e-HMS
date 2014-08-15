<?php


class DrinkSales extends Eloquent{
	protected $table = "drinksales";

	public $timestamps = "false";

	protected $guarded = array();

	public static function getIncome($today){
		$driks = DrinkSales::where('date', $today)->get();
		$total = 0;
		foreach ($driks as $d) {
			$dname = $d->drink;
			$cost  = Bar::where('name', $dname)->first()->cost;
			$total = $cost + $total;
		}
		return $total;
	}
}