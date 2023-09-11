<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Admin::create([
        //     'name'=>'Admin',
        //     'email'=>'a@gmail.com',
        //     'email_verified_at' => now(),
        //     'password'=>Hash::make('password'),
        // ]);
            // $users = User::factory(10)->create();
            

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            // ___________________Role seeding___________________
            // Role::create(['name'=>'admin']); i should have add guard name. it will healp me while im try to assign role to a table/modle
            // Role::create(['name'=>'vendor']);
            // Role::create(['name'=>'user']);

            // ___________________permisssion seedig___________________
            // Permission::create(['name' => 'see user']);
            // Permission::create(['name' => 'add user']);
            // Permission::create(['name' => 'update user']);
            // Permission::create(['name' => 'delete user']);

            // Permission::create(['name' => 'see product']);
            // Permission::create(['name' => 'add product']);
            // Permission::create(['name' => 'delete product']);
            // Permission::create(['name' => 'update product']);

            // Permission::create(['name' => 'see vendor']);
            // Permission::create(['name' => 'add vendor']);
            // Permission::create(['name' => 'delete vendor']);
            // Permission::create(['name' => 'update vendor']);

        // ____________________assigning permission to a role__________________
    //         $permission1 = Permission::findById(5);
    //         $permission2 = Permission::findById(6);
    //         $permission3 = Permission::findById(7);
    //         $permission4 = Permission::findById(8);
    //         $permission5 = Permission::findById(9);
    //         $permission6 = Permission::findById(10);
    //         $permission7 = Permission::findById(11);
    //         $permission8 = Permission::findById(12);

    //         $role = Role::findById(2);
    //         $role->syncPermissions([$permission1, $permission2, $permission3, $permission4, $permission5,
    //          $permission6,$permission7,$permission8]);
    // _____________________________Assigin Role to admin table________________________
    // $user = Admin::create([
    //         'name'=>'Admin1',
    //         'email'=>'aaaa@gmail.com',
    //         'email_verified_at' => now(),
    //         'password'=>Hash::make('password'),
    //     ]);
    // $user->guard_name = 'admin';
    // $user->assignRole("admin");
    // _________________seeding user and assigning role______________________
    // for ($i=0; $i < 10; $i++) { 
    //     $user = User::create([
    //         'name'=>fake()->name(),
    //         'email'=>fake()->unique()->safeEmail(),
    //         'email_verified_at' => now(),
    //         'password'=>Hash::make('password'),
    //     ]);
    //     $user->guard_name = 'user';
    //     $user->assignRole("user");
    // }
    // _________________seeding vendor and assigning role______________________
    // for ($i=0; $i < 10; $i++) { 
    //     $user = Vendor::create([
    //         'name'=>fake()->name(),
    //         'email'=>fake()->unique()->safeEmail(),
    //         'email_verified_at' => now(),
    //         'password'=>Hash::make('password'),
    //     ]);
    //     $user->guard_name = 'vendor';
    //     $user->assignRole("vendor");
    }
    
}

