<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class JSONInbox extends Controller {

	public function receiver (Request $requestBox){
        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $output->writeln("WE ARE IN THE INBOX RECEIVER");
        $sessionHash = $requestBox->get('Hash');
        $hashesUnencrypted = DB::table('unenc')->get();
        $hashesEncrypted   = DB::table('enc')->get();
        $flag = 0;

        // Size of both Inbox's
        $dbSizeInbox = $requestBox->get('inboxSize');
        $dbSizeSafebox = $requestBox->get('safeboxSize');

        // IMPORTING SAFEBOX MESSAGES
        $output->writeln("-------SAFEBOX MESSAGES--------");


        //Check if we already synced this data before
        foreach ($hashesEncrypted as $hash) {
            if ($hash->session_hash == $sessionHash){
                $flag = 1;
            }
        }

        if($flag == 0){
            for ($i =0; $i<$dbSizeSafebox; $i++) {
                $currMsg = $requestBox->get("SAFEB".$i);
                $currPhone = $requestBox->get("SPHON".$i);
                $output->writeln($currMsg);
                $output->writeln($currPhone);


                DB::insert('insert into enc(session_hash,phone_number,message) values (?,?,?)', [$sessionHash, $currPhone, $currMsg]);
                $output->writeln("Record inserted into the database");
            }
        }

        if($flag == 1){
            $output->writeln("This session already exists!");
        }

        //IMPORTING INBOX MESSAGES
        $output->writeln("-------INBOX MESSAGES--------");

        $flag = 0;

            //Check if we already synced this data before
            foreach ($hashesUnencrypted as $hash) {
                if ($hash->session_hash == $sessionHash){
                    $flag = 1;
                }
            }

            if($flag == 0){
                for ($i =0; $i<$dbSizeInbox; $i++) {
                    $currMsg = $requestBox->get("INBOX".$i);
                    $currPhone = $requestBox->get("IPHON".$i);
                    $output->writeln($currMsg);
                    $output->writeln($currPhone);


                    DB::insert('insert into unenc(session_hash,phone_number,message) values (?,?,?)', [$sessionHash, $currPhone, $currMsg]);
                    $output->writeln("Record inserted into the database");
                }
            }

            if($flag == 1){
                $output->writeln("This session already exists!");
            }

    }

}
