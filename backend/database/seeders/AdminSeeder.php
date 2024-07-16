<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
            'profile' => 'user.avif',
            'store_id' => 0
        ]);

        $writer = User::create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('password'),
            'store_id' => 0
        ]);

        $owner = User::create([
            'name'=>'Owner',
            'email'=>'owner@gmail.com',
            'password'=>bcrypt('password'),
            'store_id' => 0
        ]);
        


        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'user']);
        $owner_role = Role::create(['name' => 'owner']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Province access']);
        $permission = Permission::create(['name' => 'Province edit']);
        $permission = Permission::create(['name' => 'Province create']);
        $permission = Permission::create(['name' => 'Province delete']);
        
        $permission = Permission::create(['name' => 'Category access']);
        $permission = Permission::create(['name' => 'Category edit']);
        $permission = Permission::create(['name' => 'Category create']);
        $permission = Permission::create(['name' => 'Category delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'Slideshow access']);
        $permission = Permission::create(['name' => 'Slideshow edit']);
        $permission = Permission::create(['name' => 'Slideshow create']);
        $permission = Permission::create(['name' => 'Slideshow delete']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);

        $permission = Permission::create(['name' => 'Service access']);
        $permission = Permission::create(['name' => 'Service edit']);
        $permission = Permission::create(['name' => 'Service create']);
        $permission = Permission::create(['name' => 'Service delete']);

        $permission = Permission::create(['name' => 'Payment access']);
        $permission = Permission::create(['name' => 'Payment create']);

        $permission = Permission::create(['name' => 'Booking access']);
        $permission = Permission::create(['name' => 'Booking create']);

        
        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        $owner->assignRole($owner_role);


        $admin_role->givePermissionTo(Permission::all());
    }
}
