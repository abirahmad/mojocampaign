<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roleUser = Role::create(['name' => 'User']);

        /**
         * Basic User Permissions
         */
        $basicUserPermissions = [
            // View Website
            'website.view',

            // Login
            'website.login',
            'website.register',

            // question
            'website.question_answer'
        ];



        for ($i = 0; $i < count($basicUserPermissions); $i++) {
            $permission = Permission::create(['name' => $basicUserPermissions[$i]]);
            $roleUser->givePermissionTo($permission);
            $permission->assignRole($roleUser);
        }


        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);

        /**
         * Admin User Permissions
         */
        $adminUserPermissions = [

            // has admin access
            'admin.access',

            // Dashboard View
            'dashboard.view',

            // permission manage
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.delete',

            // role manage
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',


            // user manage
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // response
            'response.view',
            'response.create',
            'response.edit',
            'response.delete',

            // question set
            'question_set.view',
            'question_set.create',
            'question_set.edit',
            'question_set.delete',

            // question
            'question.view',
            'question.create',
            'question.edit',
            'question.delete',

            // site settings
            'settings.view',
            'settings.create',
            'settings.edit',

            // admin
            'admin.view',
            'admin.create',
            'admin.edit',
            'admin.delete',

            // pages
            'pages.view',
            'pages.create',
            'pages.edit',
            'pages.delete',

            // blogs
            'blogs.view',
            'blogs.create',
            'blogs.edit',
            'blogs.delete',

            // admin profile
            'admin_profile.view',
            'admin_profile.edit',

        ];

        for ($i = 0; $i < count($adminUserPermissions); $i++) {
            $permission = Permission::create(['name' => $adminUserPermissions[$i]]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }
}
