<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
      protected $fillable = [
        'patients_name',
        'patients_phone',
        'problem',
        'patient_image',
        
    ];

     public function getPatientImageUrlAttribute()
    {
        return $this->patient_image
            ? asset($this->patient_image)
            : asset('images/no-patient.png');
    } 
}
