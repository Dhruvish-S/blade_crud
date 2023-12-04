<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class UserRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    Public $email_data;
    /**
     * Create a new job instance.
     */
    public function __construct($email_data)
    {
        $this->email_data = $email_data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $email = $this->email_data;
          Mail::send('users/welcomeemail', $email, function ($message) use ($email) {
            $message->to($email['email'], $email['first_name'], $email['last_name'])
                ->subject('Welcome to Register User')
                ->from('dsorathiya@patoliyainfotech.com', 'RegisterUser');
        });
    }
}
