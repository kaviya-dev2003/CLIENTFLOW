<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'view dashboard',
            'create project', 'edit project', 'view project', 'delete project',
            'create client', 'edit client', 'view client', 'delete client',
            'view finance', 'edit finance',
            'manage users'
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles and Assign Permissions
        $superAdmin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        // Super admin gets all permissions automatically via Gate in AuthServiceProvider usually

        $admin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->givePermissionTo([
            'view dashboard',
            'create project', 'edit project', 'view project',
            'create client', 'edit client', 'view client',
            'view finance', 'edit finance'
        ]);

        $staff = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'web']);
        $staff->givePermissionTo([
            'view dashboard',
            'view project'
        ]);

        $viewer = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Viewer', 'guard_name' => 'web']);
        $viewer->givePermissionTo([
            'view dashboard',
            'view project',
            'view client'
        ]);
    }
}
