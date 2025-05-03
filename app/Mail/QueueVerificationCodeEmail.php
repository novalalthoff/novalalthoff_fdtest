<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueVerificationCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $code;

    public function __construct($code)
    {
        $this->subject = '[novalalthoff_fdtest] Verification Code';
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.verification-code')
            ->with(['code' => $this->code]);
    }
}
