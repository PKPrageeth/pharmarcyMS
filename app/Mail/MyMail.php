<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('your_email@gmail.com')
            ->view('emails.mymail')
            ->subject('My Mail Subject')
            ->with([
                'message' => 'This is my test email',
            ]);
        return 'Email was sent';
//        return $this->view('view.name');
    }
}
