<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class MedicalTest extends Model
{

    use HasFactory;

protected $fillable = [
    'patients_name',
    'patients_phone',
    'problem',
    'test_name',
    'amount',
    ];


    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    
}
