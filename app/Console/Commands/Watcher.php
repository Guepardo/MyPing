<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Site; 
use App\Verify; 
use App\Notification; 

use Carbon\Carbon; 
use App\Utils\VerifyUrl; 

class Watcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'watch:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $sites = Site::all(); 

        foreach( $sites as $site){
            $last = Carbon::parse($site->last_seen);
            $diff = $last->diffInMinutes(Carbon::now()); 

            // if($site->priority->value <= $diff || empty($site->last_seen)){
            if(true){
                $this->info("Executar aqui ". $site->label. " label ". $site->priority->label); 

                $status = VerifyUrl::verify($site->url); 
                // $this->info($status); 

                //Saving verification
                $verify = new Verify(); 
                $verify->site_id = $site->id; 
                $verify->status  = $status; 
                $verify->save(); 

                $site->last_seen = Carbon::now()->toDateTimeString(); 
                $site->save(); 

                //if status has been returned bad
                if($status == 404 || $status == 0){
                    $notification = new Notification(); 

                    $notification->user_id = 1; 
                    $notification->verify_id = $verify->id; 
                    $notification->save(); 
                }
            }
            
        }
    }
}
