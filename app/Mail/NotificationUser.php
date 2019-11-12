<?php

namespace App\Mail;
use Auth ;
use App\RequestSubmittion ;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationUser extends Mailable
{
    use Queueable, SerializesModels;

    public $data ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RequestSubmittion $data)
    {
        $this->data = $data ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.NotificationUser')
                    ->subject('Request '. $this->data->request_number .' Assign by ' . Auth::user()->name.'') ;
    }
}
