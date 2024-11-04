<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of permissions
        $permissions = [
            'add-user',
            'edit-user',
            'delete-user',
            'add-category',
            'edit-category',
            'delete-category',
            'add-merk',
            'edit-merk',
            'delete-merk',
            'add-product',
            'edit-product',
            'delete-product',
        ];

        // Create permissions if they do not exist
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // List of roles
        $roles = [
            'superadmin',
            'cashier',
            'customer'
        ];

        // Create roles if they do not exist
        foreach ($roles as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }

        // Assign permissions to superadmin role
        $roleAdmin = Role::findByName('superadmin');
        foreach ($permissions as $permission) {
            $roleAdmin->givePermissionTo($permission);
        }
    }
}
