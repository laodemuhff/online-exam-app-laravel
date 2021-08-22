<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSessionCode extends Mailable
{
    use Queueable, SerializesModels;

    protected $enroll;
    protected $session_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->enroll = $details['enroll'];
        $this->session_code = $details['session_code'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'Online Exam'))
                    ->markdown('emails.send_session', [
                        'exam_session_code' => $this->enroll['examSession']->exam_session_code,
                        'exam_name' => $this->enroll['examSession']['exam']->exam_title,
                        'schedule' => $this->enroll['examSession']->exam_datetime,
                        'session_code' => $this->session_code
                    ]);
    }
}
