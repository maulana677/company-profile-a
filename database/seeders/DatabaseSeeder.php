<?php

namespace Database\Seeders;

use App\Models\FaqSectionSetting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        \App\Models\FooterInfo::factory(1)->create();
        \App\Models\FaqSectionSetting::factory(1)->create();
    }
}
