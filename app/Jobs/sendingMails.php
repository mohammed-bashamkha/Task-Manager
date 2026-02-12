<?php

namespace App\Jobs;

use App\Mail\SendMailToUsers;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class sendingMails implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
            User::chunk(100, function ($users) {
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new SendMailToUsers($user, $this->data['title'], $this->data['body']));
                }
            });
    }
}
