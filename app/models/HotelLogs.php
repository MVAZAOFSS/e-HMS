<?php

class HotelLogs extends Eloquent{
	protected $table       = "hotellogs";
	public    $timestamps  = false;
	protected $guarded     = array();

	public static function getIncome($today){
		$logs = HotelLogs::where('date', $today)->get();
		$total = 0;
		foreach ($logs as $log) {
			$rid       = Guest::find($log->guestid)->room_number;
			$room_cost = Room::find($rid)->cost;
			$total = $room_cost + $total;
		}
		return $total;
	}
}