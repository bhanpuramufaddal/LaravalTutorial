<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Create some roles and permissions.

     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::where('name', 'Admin')->first();
        // create admin user
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password'=> bcrypt('password'),
        ]);
        $user->assignRole($adminRole);
        
    }
}