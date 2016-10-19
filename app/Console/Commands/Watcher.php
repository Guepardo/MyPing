<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Site; 
use App\Verify; 
use App\Notification; 
use App\Status; 

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

                $statusCode = VerifyUrl::verify($site->url); 
                // $this->info($status); 

                //Saving verification
                $verify = new Verify(); 
                $verify->site_id = $site->id; 

                $status = Status::where('code', $statusCode)->first();

                $verify->status_id  = $status->id; 
                $verify->save(); 

                $site->last_seen = Carbon::now()->toDateTimeString(); 
                $site->save(); 

                //if status has been returned bad
                //Write an Enumeration to this. 
                if($status->alert == 3 ){
                    $notification = new Notification(); 

                    $notification->user_id = 1; 
                    $notification->verify_id = $verify->id; 
                    $notification->save(); 
                }
            }
            
        }
    }
}
