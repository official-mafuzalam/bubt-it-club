<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles and permissions
        $roles = [
            'super_admin',
            'admin',
            'user'
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = [
            'announcement',
            'announcement_create',
            'accounts',
            'income',
            'income_create',
            'income_edit',
            'income_delete',
            'expense',
            'expense_create',
            'expense_edit',
            'expense_delete',
            'event',
            'event_create',
            'event_edit',
            'event_delete',
            'member',
            'member_create',
            'member_edit',
            'member_delete',
            'project',
            'project_create',
            'project_edit',
            'project_delete',
            'blog',
            'blog_create',
            'blog_edit',
            'blog_delete',
            'gallery',
            'gallery_create',
            'gallery_edit',
            'gallery_delete',
            'contact',
            'role',
            'permission',
            'user',
            'user_create',
            'user_edit',
            'user_delete',
            'user_block',
            'user_assign_role',
            'user_assign_permission'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign all permissions to super_admin
        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole) {
            $superAdminRole->syncPermissions($permissions);
        }
    }
}