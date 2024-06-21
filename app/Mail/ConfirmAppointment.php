<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Doctor ;
use App\Models\Patient ;

class ConfirmAppointment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment ;
    }

    public function build()
    {
        $doctor = Doctor::where('id' , $this->appointment->doctor_id)->value('name');
        $patient = Patient::where('id' , $this->appointment->patient_id)->value('name') ;
        return $this->from('MedVesta@gmail.com' , "MedaVesta")->view("website.emails.Confirm_booking")
        ->with([
            'doctor' => $doctor ,
            'day' => $this->appointment->day ,
            'oclock' => $this->appointment->oclock ,
            'date' => $this->appointment->date ,
            'patient' => $patient
        ]);
    }
}
