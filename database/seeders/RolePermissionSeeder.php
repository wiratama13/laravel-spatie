<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $default_user_role = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {

            $it = User::create(array_merge([
                'email' => 'it@mail.com',
                'name' => 'it'
            ], $default_user_role));

            $staff = User::create(array_merge([
                'email' => 'staff@mail.com',
                'name' => 'staff'
            ], $default_user_role));

            $spv = User::create(array_merge([
                    'email' => 'spv@mail.com',
                    'name' => 'spv'
                ], $default_user_role));

            $manager = User::create(array_merge([
                'email' => 'manager@mail.com',
                'name' => 'manager'
            ], $default_user_role));

            $role_staff = Role::create(['name' => 'staff']);
            $role_spv = Role::create(['name' => 'spv']);
            $role_manager = Role::create(['name' => 'manager']);
            $role_it = Role::create(['name' => 'IT']);

            $permission = Permission::create(['name' => 'read configure/roles']);
            $permission = Permission::create(['name' => 'create configure/roles']);
            $permission = Permission::create(['name' => 'update configure/roles']);
            $permission = Permission::create(['name' => 'delete configure/roles']);
            
            $permission = Permission::create(['name' => 'read configure/permissions']);
            $permission = Permission::create(['name' => 'read configure']);

            $role_it->givePermissionTo('read configure/roles');
            $role_it->givePermissionTo('create configure/roles');
            $role_it->givePermissionTo('update configure/roles');
            $role_it->givePermissionTo('delete configure/roles');

            $role_it->givePermissionTo('read configure/permissions');

            $staff->assignRole('staff');
            $spv->assignRole('spv');
            $manager->assignRole('manager');
            $it->assignRole('IT');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
