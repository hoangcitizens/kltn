<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'description',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_services', 'service_id', 'event_id')
            ->withPivot('quantity', 'total_price')
            ->withTimestamps();
    }
} 