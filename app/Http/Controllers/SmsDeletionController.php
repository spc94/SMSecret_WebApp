<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SmsDeletionController extends Controller {

	public static function deleteSmsEnc($id){
        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $output->writeln('DEBUG0!');
        $output->writeln(SessionController::getHash());
        $encTable = DB::table('enc')->where('session_hash',SessionController::getHash())->get();

        //Loop to iterate the first x rows
        foreach ($encTable as $rowID => $row){
            if($rowID == $id){
                $idOnServer = $row->id;
                break;
            }
        }
        $output->writeln('DEBUG1!');
        $output->writeln('ID on Server: '.$idOnServer);

        DB::table('deletesmsenc')->insertGetId(
            array('session_hash' => SessionController::getHash(),
                'messageIDOnAndroid' => $id,
                'messageIDOnServer'  => $idOnServer)
        );

        // Removing from Server
        DB::table('enc')->where('id',$idOnServer)->delete();

        // Returning the view again
        $inbox   = DB::table('unenc')->where('session_hash',SessionController::getHash())->get();
        $safebox = DB::table('enc')->where('session_hash',SessionController::getHash())->get();
        /*return view("inbox")->with(array('inbox' => $inbox,
            'safebox' => $safebox));*/
        return redirect('/QRHome')->with(array('inbox' => $inbox,
            'safebox' => $safebox));
    }

    public static function deleteSmsUnenc($id){
        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $output->writeln('DEBUG0!');
        $output->writeln(SessionController::getHash());
        $unencTable = DB::table('unenc')->where('session_hash',SessionController::getHash())->get();

        //Loop to iterate the first x rows
        foreach ($unencTable as $rowID => $row){
            if($rowID == $id){
                $idOnServer = $row->id;
                break;
            }
        }
        $output->writeln('DEBUG1!');
        $output->writeln('ID on Server: '.$idOnServer);

        DB::table('deletesmsunenc')->insertGetId(
            array('session_hash' => SessionController::getHash(),
                     'messageIDOnAndroid' => $id,
                     'messageIDOnServer'  => $idOnServer)
        );

        // Removing from Server
        DB::table('unenc')->where('id',$idOnServer)->delete();

        // Returning the view again
        $inbox   = DB::table('unenc')->where('session_hash',SessionController::getHash())->get();
        $safebox = DB::table('enc')->where('session_hash',SessionController::getHash())->get();
        /*return view("inbox")->with(array('inbox' => $inbox,
            'safebox' => $safebox));*/
        return redirect('/QRHome')->with(array('inbox' => $inbox,
            'safebox' => $safebox));
    }

}
