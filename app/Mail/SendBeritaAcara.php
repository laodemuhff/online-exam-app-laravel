<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class SendBeritaAcara extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $pdf;

    public function __construct($all_user, $user, $exam_session)
    {
        $this->pdf = PDF::loadView('pdf.berita_acara', [
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
                    ->markdown('emails.send_berita_acara')
                    ->attachData($this->pdf->output(), 'berita_acara.pdf');
    }
} 