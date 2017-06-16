<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller {


    public static function setTime(){
        $date = new \DateTime();
        $formatted_date = $date->format('Y-m-d H:i:s');

        Session::set('time', $formatted_date);
    }

    public static function hasSession(){
        if(Session::has('time') && Session::has('session_hash'))
            return true;
        else
            return false;
    }

    public static function functionName(){
        return "Hello World";
    }

    public static function getTime(){
        return "" . Session::get('time');
    }

    public static function setHash($hash){
        Session::set('session_hash', $hash);
    }

    public static function getHash(){
        return Session::get('session_hash');
    }

	public function checkAuthentication(){
        // Check if getHash() equals any value on our auth table
    }

}
