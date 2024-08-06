<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\WelcomeClient as MailWelcomeClient;

class WelcomeClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $userInfo;
    public function __construct($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userInfo['email'], $this->userInfo['name'])->send(new MailWelcomeClient($this->userInfo));
    }
}
