<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class QRCodeHome extends Controller {

	//

    //public function index()
    //{
        /*$renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight(256);
        $renderer->setWidth(256);
        $writer = new \BaconQrCode\Writer($renderer);
        $writer->writeFile('Hello World!', 'qrcode.png');*/
        //return view("QRHomeView", ["writer"=>$writer]);
        //return View::make("QRHomeView")->with(array('writer'=>$writer));
        //return View::make('QRHomeView');
   // }

    public function displayQR(){
        $random_hash = Hash::make(str_random(8));

        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);

        $date = new \DateTime();
        $date->modify("-2 minutes");
        $formatted_date = $date->format('Y-m-d H:i:s');

        //If the QR Code has been shown for longer than 2 minutes we generate a new one

        if(SessionController::hasSession()) {
            $output->writeln("Has a session!");
            if ($formatted_date >= SessionController::getTime()) {
                $output->writeln("Session has existed for longer than 2 minutes!");
                SessionController::setTime();
                SessionController::setHash($random_hash);
            }

            if($this->hasAuthenticated(SessionController::getHash())) {
                $inbox   = DB::table('unenc')->where('session_hash',SessionController::getHash())->get();
                /*$output->writeln("SAMPLE OF MESSAGES:");
                foreach ($inbox as $record){
                    $output->writeln("".$record->message);
                }*/
                $safebox = DB::table('enc')->where('session_hash',SessionController::getHash());
                $output->writeln("Size of Inbox: ".count($inbox));
                $output->writeln("Size of Safebox: ".count($safebox));
                return view("inbox")->with(array('inbox' => $inbox,
                                                        'safebox' => $safebox));
            }
            else
                return view("QRHomeView")->with(array('writer' => SessionController::getHash()));

        }
        else{
            $output->writeln("Doesn't have a session!");
            SessionController::setTime();
            SessionController::setHash($random_hash);
            return view("QRHomeView")->with(array('writer' => SessionController::getHash()));
        }

    }

    private function hasAuthenticated($session_hash){
        $hashes = DB::table('auth')->get();

        foreach ($hashes as $hash) {
            if($hash->session_hash == $session_hash){
                return true;
            }
        }
        return false;
    }

}
