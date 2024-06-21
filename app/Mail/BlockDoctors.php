<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlockDoctors extends Mailable
{
    use Queueable, SerializesModels;

            /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doctor)
    {
        $this->doctor = $doctor ;
    }

    public function build()
    {
        return $this->from('MedVesta@gmail.com' , "MedaVesta")->view("admin.emails.doctor_block")
        ->with([
            'name' => $this->doctor->name
        ]);

    }
}
