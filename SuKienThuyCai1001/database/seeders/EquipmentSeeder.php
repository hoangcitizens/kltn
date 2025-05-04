<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;
use App\Models\Category;
use App\Models\EquipmentType;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy danh mục "Thiết bị âm thanh"
        $soundCategory = Category::where('slug', 'tiec-cuoi')->first();
        
       

        // Lấy loại thiết bị
        $soundType = EquipmentType::where('equipment_type_name', 'Thiết bị âm thanh')->first();
        $lightType = EquipmentType::where('equipment_type_name', 'Thiết bị ánh sáng')->first();
        $furnitureType = EquipmentType::where('equipment_type_name', 'Bàn ghế')->first();
        $tentType = EquipmentType::where('equipment_type_name', 'Nhà bạt, không gian trưng bày')->first();
        $decorationType = EquipmentType::where('equipment_type_name', 'Dụng cụ trang trí')->first();

        // Thiết bị âm thanh
        Equipment::create([
            'name' => 'Loa JBL EON 615',
            'description' => 'Loa công suất cao, công suất 1000W, phù hợp cho sự kiện ngoài trời',
            'image' => 'equipment/jbl-eon-615.jpg',
            'price' => 500000,
            'quantity' => 4,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $soundType->id
        ]);

        Equipment::create([
            'name' => 'Mixer âm thanh Yamaha MG10XU',
            'description' => 'Mixer 10 kênh, tích hợp hiệu ứng, phù hợp cho sự kiện vừa và nhỏ',
            'image' => 'equipment/yamaha-mg10xu.jpg',
            'price' => 300000,
            'quantity' => 2,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $soundType->id
        ]);

        Equipment::create([
            'name' => 'Micro không dây Shure BLX288',
            'description' => 'Bộ micro không dây 2 cái, tần số UHF, phù hợp cho MC và ca sĩ',
            'image' => 'equipment/shure-blx288.jpg',
            'price' => 400000,
            'quantity' => 3,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $soundType->id
        ]);

        // Thiết bị ánh sáng
        Equipment::create([
            'name' => 'Đèn LED Par 64 RGB',
            'description' => 'Đèn LED Par 64, điều khiển DMX, hiệu ứng đa màu',
            'image' => 'equipment/led-par-64.jpg',
            'price' => 200000,
            'quantity' => 8,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $lightType->id
        ]);

        Equipment::create([
            'name' => 'Đèn Moving Head 230W',
            'description' => 'Đèn Moving Head công suất 230W, điều khiển DMX, hiệu ứng đa dạng',
            'image' => 'equipment/moving-head-230w.jpg',
            'price' => 600000,
            'quantity' => 4,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $lightType->id
        ]);

        Equipment::create([
            'name' => 'Đèn Laser RGB',
            'description' => 'Đèn Laser RGB, điều khiển DMX, hiệu ứng laser đa màu',
            'image' => 'equipment/laser-rgb.jpg',
            'price' => 350000,
            'quantity' => 2,
            'status' => 'maintenance',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $lightType->id
        ]);

        // Bàn ghế
        Equipment::create([
            'name' => 'Bàn tròn 1.2m',
            'description' => 'Bàn tròn đường kính 1.2m, phù hợp cho 8-10 người',
            'image' => 'equipment/table-1.2m.jpg',
            'price' => 150000,
            'quantity' => 20,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $furnitureType->id
        ]);

        Equipment::create([
            'name' => 'Ghế gấp cao cấp',
            'description' => 'Ghế gấp cao cấp, chịu lực tốt, dễ dàng vận chuyển',
            'image' => 'equipment/folding-chair.jpg',
            'price' => 50000,
            'quantity' => 200,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $furnitureType->id
        ]);

        // Nhà bạt
        Equipment::create([
            'name' => 'Nhà bạt 5x10m',
            'description' => 'Nhà bạt kích thước 5x10m, chống nắng mưa tốt',
            'image' => 'equipment/tent-5x10.jpg',
            'price' => 1000000,
            'quantity' => 5,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $tentType->id
        ]);

        // Dụng cụ trang trí
        Equipment::create([
            'name' => 'Bóng bay trang trí',
            'description' => 'Bộ bóng bay trang trí đa màu, kèm bơm hơi',
            'image' => 'equipment/decoration-balloons.jpg',
            'price' => 200000,
            'quantity' => 10,
            'status' => 'available',
            'category_id' => $soundCategory->id,
            'equipment_type_id' => $decorationType->id
        ]);
    }
}