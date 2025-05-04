<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_RETURNED = 'returned';
    const STATUS_OVERDUE = 'overdue';

    protected $table = 'booking_requests';
    protected $primaryKey = 'booking_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'equipment_id',
        'start_date',
        'end_date',
        'quantity',
        'total_price',
        'status',
        'payment_status',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id', 'id');
    }
} 