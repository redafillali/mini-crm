<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable {
    use Queueable, SerializesModels;

    public $url;

    /**
    * Create a new message instance.
    *
    * @param string $url The invitation URL to include in the email.
    * @return void
    */

    public function __construct( $url ) {
        $this->url = $url;
    }

    /**
    * Build the message.
    *
    * @return $this
    */

    public function build() {
        return $this->view( 'emails.invitation' )
        ->subject( 'Invitation à rejoindre la plateforme' );
    }
}
