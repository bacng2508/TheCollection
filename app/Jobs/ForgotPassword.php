<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword as ForgotPasswordMail;

class ForgotPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $resetInfo;
    /**
     * Create a new job instance.
     */
    public function __construct($resetInfo)
    {
        $this->resetInfo = $resetInfo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->resetInfo['email'])->send(new ForgotPasswordMail($this->resetInfo));
    }
}
