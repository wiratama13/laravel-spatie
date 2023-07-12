<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Navigation::create([
            'name' => 'Configure',
            'url' => 'configure',
            'icon' => 'ti-settings',
            'main_menu' => null
        ]);
        Navigation::create([
            'name' => 'Roles',
            'url' => 'configure/roles',
            'icon' => '',
            'main_menu' => 1
        ]);
        Navigation::create([
            'name' => 'Permissions',
            'url' => 'configure/permissions',
            'icon' => '',
            'main_menu' => 1 
        ]);
    }
}
