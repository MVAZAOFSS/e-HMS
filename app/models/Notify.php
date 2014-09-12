<?php


class Notify {
	
	public static function push($txt){
		Sms::send(array('to'=>'+255 712 315 840', 'text'=>$txt));
	}

}