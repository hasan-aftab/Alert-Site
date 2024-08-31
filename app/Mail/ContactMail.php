<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactDetails;

    public function __construct($contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    public function build()
    {
        return $this->view('mail.contact')
                    ->with([
                        'name' => $this->contactDetails['name'],
                        'email' => $this->contactDetails['email'],
                        'phone' => $this->contactDetails['phone'],
                        'text' => $this->contactDetails['message'],
                    ])
                    ->from($address = 'hello@trackrak.com', $name = 'TrackRak Contact Form')
                    ->replyTo($this->contactDetails['email'], $this->contactDetails['name'])
                    ->subject('TrackRak Contact Form');
    }
}
