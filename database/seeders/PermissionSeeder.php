<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
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
        ];
        

                  // Looping and Inserting Array's Permissions into Permission Table
                  foreach ($permissions as $permission) {
                    Permission::create(['name' => $permission]);
                  }
        
    }
}
