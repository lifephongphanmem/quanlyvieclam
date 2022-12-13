<?php

namespace App\Jobs;

use App\Mail\MailDoanhNghiep;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SenMailDoanhNghiep implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $modeldn;
    protected $contentdn;
    protected $filedn;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($modeldn,$contentdn,$filedn)
    {
        $this->modeldn=$modeldn;
        $this->contentdn=$contentdn;
        $this->filedn=$filedn;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emaildn = new MailDoanhNghiep($this->contentdn,$this->modeldn,$this->filedn);
        if(isset($this->modeldn)){
            Mail::to($this->modeldn->email)->send($emaildn);
        }
    }
}
