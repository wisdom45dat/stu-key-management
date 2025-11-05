<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'access dashboard',
            'access kiosk',
            'process checkout',
            'process checkin',
            'view keys',
            'manage keys',
            'generate qr codes',
            'mark keys lost',
            'view locations',
            'manage locations',
            'view hr',
            'manage hr',
            'import staff',
            'resolve discrepancies',
            'view reports',
            'view analytics',
            'export data',
            'view users',
            'manage users',
            'manage roles',
            'manage settings',
            'view system health',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions($permissions);

        $hrRole = Role::firstOrCreate(['name' => 'hr', 'guard_name' => 'web']);
        $hrRole->syncPermissions([
            'access dashboard',
            'view keys',
            'view locations',
            'view hr',
            'manage hr',
            'import staff',
            'resolve discrepancies',
            'view reports',
            'view analytics',
            'export data',
        ]);

        $securityRole = Role::firstOrCreate(['name' => 'security', 'guard_name' => 'web']);
        $securityRole->syncPermissions([
            'access dashboard',
            'access kiosk',
            'process checkout',
            'process checkin',
            'view keys',
            'view locations',
            'mark keys lost',
            'view reports',
        ]);

        $auditorRole = Role::firstOrCreate(['name' => 'auditor', 'guard_name' => 'web']);
        $auditorRole->syncPermissions([
            'access dashboard',
            'view keys',
            'view locations',
            'view hr',
            'view reports',
            'view analytics',
            'export data',
        ]);

        $this->command->info('Roles and permissions seeded successfully!');
    }
}
