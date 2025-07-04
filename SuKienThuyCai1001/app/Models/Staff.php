<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'price',
        'image',
        'description'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 