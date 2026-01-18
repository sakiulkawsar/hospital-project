<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctors_name',
        'doctors_phone',
        'specialty',
        'room_number',
        'doctor_image',
    ];




    public function getDoctorImageUrlAttribute()
    {
        return $this->doctor_image
            ? asset($this->doctor_image)
            : asset('images/no-doctor.png');
    }
}
