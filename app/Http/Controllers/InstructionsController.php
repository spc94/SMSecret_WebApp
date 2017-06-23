<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class InstructionsController extends Controller {

	public function deleteSmsEnc(Request $request){
        $sessionHash     = $request->get('Hash');
        $tableJoinedHash = DB::table('deletesmsenc')->where('session_hash',$sessionHash)->get();
        $idArrayAndroid         = array();

        foreach ($tableJoinedHash as $row){
            array_push($idArrayAndroid,$row->messageIDOnAndroid);
        }

        DB::table('deletesmsenc')->where('session_hash',$sessionHash)->delete();

        return response()->json([
            'id' => $idArrayAndroid
        ]);
    }

    public function deleteSmsUnenc(Request $request){
	    $sessionHash     = $request->get('Hash');
	    $tableJoinedHash = DB::table('deletesmsunenc')->where('session_hash',$sessionHash)->get();
	    $idArrayAndroid         = array();

	    foreach ($tableJoinedHash as $row){
	        array_push($idArrayAndroid,$row->messageIDOnAndroid);
        }

        DB::table('deletesmsunenc')->where('session_hash',$sessionHash)->delete();

        return response()->json([
            'id' => $idArrayAndroid
        ]);
    }

    public function sendSms(Request $request){
        $sessionHash     = $request->get('Hash');
        $tableJoinedHash = DB::table('sendsms')->where('session_hash',$sessionHash)->get();
        $phoneArray      = array();
        $messageArray    = array();

        foreach ($tableJoinedHash as $row) {
            array_push($phoneArray,   $row->destination);
            array_push($messageArray, $row->message);
        }

        DB::table('sendsms')->where('session_hash',$sessionHash)->delete();

        return response()->json([
            'phone'   => $phoneArray,
            'message' => $messageArray
        ]);
    }

}
