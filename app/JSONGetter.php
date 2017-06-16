<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JSONGetter extends Controller {

    public $timestamps=true;

    public function receiver(Request $request)
    {
        //$data = $request->json()->all();
        $sessionHash = $request->get('Hash');
        $phoneID = $request->get('ID');
        //$jsonArray = json_decode($request->json());

        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $output->writeln('New Connection!');
        //$output->writeln("Ola!");
        //$output->writeln($data);

        //$output->writeln("Everything: ");
        //$output->writeln($data);
        //$output->writeln("########################");
        //$output->writeln("Phone ID: ");
        //$output->writeln($phoneID);
        //$output->writeln("Session Hash: ");
        //$output->writeln($sessionHash);
        //$output->writeln($jsonArray);

        $current_time = time();
        //$output->writeln("Time: ");
        //$output->writeln($current_time);
        //$data = array();
        //$data['created_at'] =new \DateTime();


        //DB::table('auth')->insert($data);
        //DB::insert('insert into auth(created_at) values(?)',[time()]);
        //JSONGetter::session_exists();
        $hashes = DB::table('auth')->get();
        //$output->writeln(count($hashes));
        //If Table is Empty insert data
        $flag = 0;
        //Check if it's our QR Code. It always starts with $2y$10$
        $output->writeln($sessionHash);
        if (substr($sessionHash, 0, 7) == "$2y$10$") {
            if (count($hashes) == 0) {
                DB::insert('insert into auth(session_hash,phone_id,created_at) values (?,?,?)', [$sessionHash, $phoneID, new \DateTime()]);
                $output->writeln("Record inserted into the database");
                $flag = 1;
            }
            foreach ($hashes as $hash) {
                //if($hash->phone_id== $phoneID)
                //Remove all sms from corresponding table
                //If session hash already exists
                if ($hash->session_hash == $sessionHash) {
                    $output->writeln("Hash Already exists!");
                    $flag = 1;
                } //If session hash doesn't exist
                else {
                    $output->writeln("Hash Doesn't exist yet!");
                }
            }
            // If we didn't find a repeated Session Hash
            if ($flag == 0) {
                DB::insert('insert into auth(session_hash,phone_id,created_at) values (?,?,?)', [$sessionHash, $phoneID, new \DateTime()]);
                $output->writeln("Record inserted into the database");

            }
        }
        else{
            $output->writeln("Wrong QR Code!");
        }
    }

    /*public static function session_exists(){
        $hashes = DB::table('session_hash')->get();
        $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
        $output->writeln("Printing shiet");
        //echo "kek";
        foreach($hashes as $hash){
            $output->writeln($hash);
        }
        //return "123";
    }*/

	//

}
