<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvolvementAcknowledgement extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your ACEF application!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.involvement-acknowledgement',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
