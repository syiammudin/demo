<?php

namespace App\Mail;
use Auth ;
use App\VendorManagement ;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationUserVendor extends Mailable
{
    use Queueable, SerializesModels;

    public $data ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VendorManagement $data)
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
