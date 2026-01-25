<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email_address',
        'submission_date',
        'specialty_id',
        'doctor_id',
        'number',
        'message',
        'status',
        'appointment_date',
        'appointment_time',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
