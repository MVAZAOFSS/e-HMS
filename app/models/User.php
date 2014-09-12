<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';



    public $autoPurgeRedundantAttributes = true;

    protected $guarded = array('_token');

    public static $rules = array(
        'email'              => 'required|between:4,16|unique:users',
        'level'              => 'required',
        'gender'             => 'required',
        'phone'              => 'between:10,14',
      );

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */

    public static function active($s){
        if($s == "active"){
            return "checked";
        }else{
            return "";
        }
    }

    public static function blocked($s){
        if($s == "blocked"){
            return "checked";
        }else{
            return "";
        }
    }

    public static function smartTabs($v){
        if(isset($_GET[$v])){
           return '<li class=""><a href="#home" data-toggle="tab">Add Users</a></li>
           <li class="active"><a href="#profile" data-toggle="tab" >System Users</a></li>';
        }else{
           return '<li class="active"><a href="#home" data-toggle="tab">Add Users</a></li>
           <li class=""><a href="#profile" data-toggle="tab" >System Users</a></li>';
        }
    }


    public static function status($v){
        if($v == 'yes'){
            return 'active';
        }else{
            return 'blocked';
        }
    }

    public static function  ago($datetime, $full = false)
    {
            
            if($datetime == '-0001-11-30 00:00:00'){
                return 'never';
            }else{
                $now = new DateTime;
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);

                $diff->w = floor($diff->d / 7);
                $diff->d -= $diff->w * 7;

                $string = array(
                    'y' => 'year',
                    'm' => 'month',
                    'w' => 'week',
                    'd' => 'day',
                    'h' => 'hour',
                    'i' => 'minute',
                    's' => 'second',
                );
                foreach ($string as $k => &$v) {
                    if ($diff->$k) {
                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                    } else {
                        unset($string[$k]);
                    }
                }

                if (!$full) $string = array_slice($string, 0, 1);
                return $string ? implode(', ', $string) . ' ago' : 'just now';
                }
    }

    public static function role($v){
        if($v == 1){
            return ' * Administrator ';
        }else if($v == 2){
            return ' * Secretary ';
        }else if($v == 3){
            return ' * Accountant';
        }else if($v == 4){
            return ' * Store Keeper';
        }else if($v == 5){
            return ' * Laundary ';
        }else if($v == 6){
            return ' * Bar - Waiter/Waitres ';
        }else if($v == 7){
            return ' * Restaurant - Waiter/Waitres ';
        }else if($v == 8){
            return ' * Bar - Waiter/Waitres ';
        }else if($v == 9){
            return ' * Manager ';
        }else if($v == 10){
            return ' * Room Controller ';
        }else if($v == 11){
            return ' * Director ';
        }

    }

    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}