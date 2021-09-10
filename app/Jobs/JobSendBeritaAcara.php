<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendBeritaAcara;
use Mail;

class JobSendBeritaAcara implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $enroll;
    protected $exam_session;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $enroll, $exam_session)
    {
        $this->users = $users;
        $this->enroll = $enroll;
        $this->exam_session = $exam_session;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendBeritaAcara($this->users, $this->enroll['user'], $this->exam_session);
        Mail::to($this->enroll['user']['email'])->send($email);
    }
}
