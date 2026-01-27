<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'name',
        'dose',
        'time',
        'duration',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}