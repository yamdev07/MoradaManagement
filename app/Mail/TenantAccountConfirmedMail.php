<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TenantAccountConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tenant;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct($tenant, $adminName = 'Super Administrateur')
    {
        $this->tenant = $tenant;
        $this->adminName = $adminName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre compte hôtel a été confirmé - ' . $this->tenant->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tenant-account-confirmed',
            with: [
                'tenant' => $this->tenant,
                'adminName' => $this->adminName,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
