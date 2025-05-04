<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'user_id',
        'rental_date',
        'quantity',
        'total_price',
        'notes',
        'status'
    ];

    protected $casts = [
        'rental_date' => 'date',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 