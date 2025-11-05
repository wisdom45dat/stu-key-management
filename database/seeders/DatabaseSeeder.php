<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $securityRole = Role::create(['name' => 'security']);
        $hrRole = Role::create(['name' => 'hr']);
        $auditorRole = Role::create(['name' => 'auditor']);

        // Create Admin User
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@stu.edu',
            'password' => Hash::make('password123'),
            'phone' => '+1234567890',
        ]);
        $admin->assignRole('admin');

        // Create Security User
        $security = User::create([
            'name' => 'Security Officer',
            'email' => 'security@stu.edu',
            'password' => Hash::make('password123'),
            'phone' => '+1234567891',
        ]);
        $security->assignRole('security');

        // Create HR User
        $hr = User::create([
            'name' => 'HR Manager',
            'email' => 'hr@stu.edu',
            'password' => Hash::make('password123'),
            'phone' => '+1234567892',
        ]);
        $hr->assignRole('hr');

        $this->command->info('Default users created:');
        $this->command->info('Admin: admin@stu.edu / password123');
        $this->command->info('Security: security@stu.edu / password123');
        $this->command->info('HR: hr@stu.edu / password123');
    }
}
