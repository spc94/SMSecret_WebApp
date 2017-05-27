<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class JSONInbox extends Controller {

	public function receiver (Request $requestBox){
        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $output->writeln("WE ARE IN THE INBOX RECEIVER");

        $sessionHash = $requestBox->get('Hash');

        $dbSize = $requestBox->get('dbSize');
        $output->writeln($requestBox->get('1'));
        $output->writeln($dbSize);
        for ($i =0; $i<$dbSize; $i++) {
            $currMsg = $requestBox->get("INBOX".$i);
            $currPhone = $requestBox->get("IPHON".$i);
            $output->writeln($currMsg);
            $output->writeln($currPhone);

            DB::insert('insert into unenc(session_hash,phone_number,message) values (?,?,?)', [$sessionHash, $currPhone, $currMsg]);
            $output->writeln("Record inserted into the database");
        }
    }

}
