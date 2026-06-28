<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Notifications\PasswordReset;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ForgetPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user,$reset_otp;
    public function __construct($user,$reset_otp)
    {
        $this->user = $user;
        $this->reset_otp = $reset_otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user, new PasswordReset($this->user,$this->reset_otp));
    }
}
