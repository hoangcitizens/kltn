<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'status',
        'category_id',
        'quantity',
        'equipment_type_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Quan hệ với BookingRequest
    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class, 'equipment_id', 'id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_equipment')
            ->withTimestamps();
    }

    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class, 'equipment_type_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'equipment_category');
    }
} 