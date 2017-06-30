<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SmsSendController extends Controller {

	public function smsSend(Request $request){
        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $destination     = $request->get('phone');
        $message         = $request->get('text');
        if($destination == "" || $message == "") {
            $output->writeln("NULL");
            return view('send')->with(array('sent' => "2"));
        }
        $output->writeln("Destination: ".$destination);
        $output->writeln("Message: ".$message);
        $sessionHash = SessionController::getHash();

        //Write to the proper database
        DB::insert('insert into sendsms(session_hash,destination,message) values (?,?,?)', [$sessionHash, $destination, $message]);

	    return view('send')->with(array('sent' => "1"));
    }


}
