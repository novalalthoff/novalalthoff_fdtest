<?php

namespace App\Jobs;

use App\Mail\QueueVerificationCodeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendVerificationCodeEmailJob implements ShouldQueue
{
    use Queueable;

    public $to, $code;

    /**
     * Create a new job instance.
     */
    public function __construct($to, $code)
    {
        $this->to = $to;
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->to)->send(new QueueVerificationCodeEmail($this->code));
    }
}
