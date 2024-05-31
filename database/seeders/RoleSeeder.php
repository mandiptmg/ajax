<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $productManager = Role::create(['name' => 'Product Manager']);

        $superadmin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'create-hero',
            'edit-hero',
            'delete-hero',
            'create-testimonial',
            'edit-testimonial',
            'delete-testimonial',
            'create-portfolio',
            'edit-portfolio',
            'delete-portfolio',
            'create-services',
            'edit-services',
            'delete-services',
        ]);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'create-hero',
            'edit-hero',
            'delete-hero',
            'create-testimonial',
            'edit-testimonial',
            'delete-testimonial',
            'create-portfolio',
            'edit-portfolio',
            'delete-portfolio',
            'create-services',
            'edit-services',
            'delete-services',
        ]);

        $productManager->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product',
            'create-hero',
            'edit-hero',
            'delete-hero',
            'create-testimonial',
            'edit-testimonial',
            'delete-testimonial',
            'create-portfolio',
            'edit-portfolio',
            'delete-portfolio',
            'create-services',
            'edit-services',
            'delete-services',
        ]);
    }
}
