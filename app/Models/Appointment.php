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
        'specialty',
        'number',
        'message',
    ];
}
