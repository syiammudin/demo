<?php

namespace App\Mail;

use App\VendorManagement ;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailToVendor extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VendorManagement $vendor)
    {
        $this->vendor = $vendor ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.SendToVendor')
                    ->subject('Notification Vendor Approval Questionnaire ('.date('H:i:s').')') ;
    }
}
