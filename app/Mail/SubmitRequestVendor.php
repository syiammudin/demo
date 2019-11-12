<?php

namespace App\Mail;

use App\VendorManagement ;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitRequestVendor extends Mailable
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
        return $this->markdown('emails.SubmitRequest')
        ->subject('Request to '.$this->data->vendor_name.'');
    }
}
