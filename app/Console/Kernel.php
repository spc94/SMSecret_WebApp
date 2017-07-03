<?php namespace App\Console;

use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Log;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
		$schedule->call(function(){
            Log::info('FUNCTION CALLED');
            $date = new DateTime;
            $date->modify('-30 minutes');
            Log::info("After date->modify.");
            $formatted_date = $date->format('Y-m-d H:i:s');
            Log::info("After formatted date.");

            $expiredHashes = DB::table('auth')->where('created_at','<=',$formatted_date)->get();

            foreach ($expiredHashes as $hash) {
                Log::info("Expired Hash: ".$hash->session_hash);
                Log::info("Date: ".$hash->created_at);
                DB::table('unenc')->where('session_hash',$hash->session_hash)->delete();
                DB::table('enc')->where('session_hash',$hash->session_hash)->delete();
                DB::table('deletesmsunenc')->where('session_hash',$hash->session_hash)->delete();
                DB::table('deletesmsenc')->where('session_hash',$hash->session_hash)->delete();
                DB::table('sendsms')->where('session_hash',$hash->session_hash)->delete();
                DB::table('auth')->where('session_hash',$hash->session_hash)->delete();
            }

		    Log::info("After DB Deletion.");
        })->everyFiveMinutes();
	}

}
