<?php

namespace App\Mail;

use App\RequestSubmittion ;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitRequest extends Mailable
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
        if(!empty($this->data->MasterRequest)){
            return $this->markdown('emails.SubmitRequest')
            ->subject('Request '. $this->data->request_number .' - ' .$this->data->MasterRequest->title.'');
        }else{
            return $this->markdown('emails.SubmitRequest')
            ->subject('Request to '.$this->vendor_name.'');
        }
    }
}
