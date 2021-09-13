<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class SendHasilEvaluasi extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $pdf;
    protected $exam_session;

    public function __construct($all_user, $user, $exam_session)
    {
        $this->exam_session = $exam_session;

        $this->pdf = PDF::loadView('pdf.hasil_evaluasi', [
            'all_user' => $all_user,
            'user' => $user,
            'exam_session' => $exam_session
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'Online Exam'))
                    ->markdown('emails.send_hasil_evaluasi', [
                        'exam_session' => $this->exam_session
                    ])
                    ->attachData($this->pdf->output(), 'hasil_evaluasi.pdf');
    }
}
