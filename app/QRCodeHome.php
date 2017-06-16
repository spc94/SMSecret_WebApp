<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

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
        //Not working ATM
        //$writer->writeFile('Hello World!', 'qrcode.png');
        //return view("QRHomeView");
        $random_hash = Hash::make(str_random(8));
        //QrCode::generate('Make me into a QrCode!');
        //return view("QRHomeView")->with(array('writer'=>$random_hash));
        return view("welcome");
        //return "x";
    }

}
