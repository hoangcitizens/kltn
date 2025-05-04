<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name',
        'event_date',
        'attendee_count',
        'user_id',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'event_services', 'event_id', 'service_id')
            ->withPivot('quantity', 'total_price')
            ->withTimestamps();
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'event_id', 'event_id');
    }
} 