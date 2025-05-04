<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentType;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Thiết bị âm thanh',
            'Thiết bị ánh sáng',
            'Bàn ghế',
            'Nhà bạt, không gian trưng bày',
            'Dụng cụ trang trí'
        ];

        foreach ($types as $type) {
            EquipmentType::create([
                'equipment_type_name' => $type
            ]);
        }
    }
} 