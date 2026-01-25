<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
       protected $fillable = [
        'patients_name',
        'patients_phone',
        'problem',
        'test_name',
        'amount',
        
    ];
    
}
