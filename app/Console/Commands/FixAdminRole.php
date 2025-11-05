<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class FixAdminRole extends Command
{
    protected $signature = 'fix:admin-role';
    protected $description = 'Check and fix admin user role';

    public function handle()
    {
        // Find admin user (usually the first user or one with admin email)
        $adminUser = User::where('email', 'like', '%admin%')
                        ->orWhere('email', 'like', '%@stu.edu')
                        ->orWhere('id', 1)
                        ->first();

        if (!$adminUser) {
            $this->error('No admin user found!');
            return;
        }

        $this->info("Found user: {$adminUser->name} ({$adminUser->email})");

        // Check if admin role exists
        $adminRole = Role::where('name', 'admin')->first();
        
        if (!$adminRole) {
            $this->info('Creating admin role...');
            $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        }

        // Check if user has admin role
        if (!$adminUser->hasRole('admin')) {
            $this->info('Assigning admin role to user...');
            $adminUser->assignRole('admin');
        }

        $this->info('✅ Admin role assigned successfully!');
        $this->info("User {$adminUser->name} now has roles: " . $adminUser->getRoleNames()->implode(', '));
    }
}
