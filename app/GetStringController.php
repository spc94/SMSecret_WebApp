<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GetStringController extends Controller {

	//

    public function main(){
        return Input::get("string");
    }

}
