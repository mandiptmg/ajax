<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the permissions you want to create
        $permissions = [
            'view role',
            'create role',
            'update role',
            'delete role',
            'view permission',
            'create permission',
            'update permission',
            'delete permission',
            'create permission category',
            'update permission category',
            'delete permission category',
            'view user',
            'create user',
            'update user',
            'delete user',
            'view product',
            'create product',
            'update product',
            'delete product',
            'view hero',
            'create hero',
            'update hero',
            'delete hero',
            'view about',
            'create about',
            'update about',
            'delete about',
            'view service',
            'create service',
            'update service',
            'delete service',
            'view portfolio',
            'create portfolio',
            'update portfolio',
            'delete portfolio',
            'view testimonial',
            'create testimonial',
            'update testimonial',
            'delete testimonial',
            'view header',
            'create header',
            'update header',
            'delete header',
            'create site setting',
            'create policy',
            'view policy',
            'update policy',
            'delete policy',

        ];

        // Create or get permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']); // as super-admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Let's give all permissions to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();
        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give a few permissions to admin role.
        $adminPermissions = [
            'create permission', 'view permission',
            'update permission', 'delete permission',
            'create permission category',
            'update permission category',
            'delete permission category',
            'create user', 'view user', 'update user',
            'delete user',
            'create product', 'view product', 'update product',
            'delete product',
            'view hero',
            'create hero',
            'update hero',
            'delete hero',
            'view about',
            'create about',
            'update about',
            'delete about',
            'view service',
            'create service',
            'update service',
            'delete service',
            'view portfolio',
            'create portfolio',
            'update portfolio',
            'delete portfolio',
            'view testimonial',
            'create testimonial',
            'update testimonial',
            'delete testimonial',
            'create site setting',
            'create policy',
            'view policy',
            'update policy',
            'delete policy',




        ];
        $adminRole->givePermissionTo($adminPermissions);

        // Let's create users and assign roles to them.
        $superAdminUser = User::firstOrCreate([
            'email' => 'creationsoftnepal158@gmail.com',
        ], [
            'name' => 'Robin Maharjan',
            'email' => 'creationsoftnepal158@gmail.com',
            'password' => Hash::make('creationsoftnepal159'),
        ]);
        $superAdminUser->assignRole($superAdminRole);

        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'john Wick',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $adminUser->assignRole($adminRole);
    }
}
