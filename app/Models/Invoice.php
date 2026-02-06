<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
    'medical_test_id',
    'patient_name',
    'patient_phone',
    'amount'
];
public function medicalTest()
{
    return $this->belongsTo(MedicalTest::class);
}
}
