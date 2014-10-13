<?php

class Laundrie extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public static function cate($c){
		if($c == 1){
			return "Laundry";
		}else if($c == 2){
			return "Dry Cleaning";
		}else{
			return "Pressing";
		}
	}

	public static function tick($c1, $c2){
			if($c1 == $c2){
				return "checked";
			}else{
                return " ";
            }
	}


}
