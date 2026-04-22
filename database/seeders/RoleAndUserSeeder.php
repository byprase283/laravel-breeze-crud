<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Permission (Izin)
        Permission::firstOrCreate(['name' => 'view products']);
        Permission::firstOrCreate(['name' => 'edit products']);
        Permission::firstOrCreate(['name' => 'create products']);
        Permission::firstOrCreate(['name' => 'delete products']);

        // 2. Buat Role dan Berikan Permission

        // Admin: Bisa semua (CRUD)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Staff: Hanya bisa Edit dan View
        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $staffRole->givePermissionTo(['view products', 'edit products']);

        // Guest: Hanya bisa View
        $guestRole = Role::firstOrCreate(['name' => 'guest']);
        $guestRole->givePermissionTo('view products');

        // 3. Buat User Contoh dan Hubungkan dengan Role

        // User Admin
        $admin = User::firstOrCreate([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        // User Staff
        $staff = User::firstOrCreate([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
        ]);
        $staff->assignRole($staffRole);

        // User Guest
        $guest = User::firstOrCreate([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => Hash::make('password'),
        ]);
        $guest->assignRole($guestRole);
    }
}
