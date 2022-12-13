<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDoanhNghiep extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;
    protected $modeldn;
    protected $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$modeldn,$file)
    {
        $this->content=$content;
        $this->modeldn=$modeldn;
        $this->file=$file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email=$this->subject('Thông báo')->view('mail.maildoanhnghiep');
        foreach($this->file as $file)
        {
            if($file != ''){
                $email->attach($file);
            }

        }
        return $email
                ->with('content',$this->content)
                ->with('file',$this->file)
                ->with('modeldn',$this->modeldn);
    }
}
