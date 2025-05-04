<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'site.title',
                'display_name' => 'Site Title',
                'value' => 'SuKien Thuy Cai',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ],
            [
                'key' => 'site.description',
                'display_name' => 'Site Description',
                'value' => 'Website tổ chức sự kiện chuyên nghiệp',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ],
            [
                'key' => 'site.logo',
                'display_name' => 'Site Logo',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ],
            [
                'key' => 'admin.bg_image',
                'display_name' => 'Admin Background Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ],
            [
                'key' => 'admin.title',
                'display_name' => 'Admin Title',
                'value' => 'SuKien Thuy Cai',
                'details' => '',
                'type' => 'text',
                'order' => 5,
                'group' => 'Admin',
            ],
            [
                'key' => 'admin.description',
                'display_name' => 'Admin Description',
                'value' => 'Welcome to SuKien Thuy Cai Admin Panel',
                'details' => '',
                'type' => 'text',
                'order' => 6,
                'group' => 'Admin',
            ],
        ];

        DB::table('settings')->insert($settings);
    }
} 