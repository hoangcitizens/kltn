<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_type_name'
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
} 