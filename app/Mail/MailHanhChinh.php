<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailHanhChinh extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;
    protected $modeldv;
    protected $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$modeldv,$file)
    {
        $this->content=$content;
        $this->modeldv=$modeldv;
        $this->file=$file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email=$this->subject('Thông báo')->view('mail.mailhanhchinh');
        foreach($this->file as $file)
        {
            if($file != ''){
                $email->attach($file);
            }

        }
        return  $email
                ->with('modeldv',$this->modeldv)
                ->with('file',$this->file)
                ->with('content',$this->content);
    }
}
