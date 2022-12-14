<?php

namespace App\Jobs;

use App\Mail\MailHanhChinh;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $modeldv;
    protected $contenthc;
    protected $filehc;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($modeldv,$contenthc,$filehc)
    {
        $this->modeldv=$modeldv;
        $this->contenthc=$contenthc;
        $this->filehc=$filehc;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailht = new MailHanhChinh($this->contenthc,$this->modeldv,$this->filehc);
        if(isset($this->modeldv)){
            // Mail::to($this->modeldv->email)->queue($emailht);
            Mail::to($this->modeldv->email)->send($emailht);
        }
        
               
    }
}
