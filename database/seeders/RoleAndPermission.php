<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions=[
           'view blogs',
           'edit blogs',
           'create blogs',
           'delete blogs',
           'archive blogs',
           'restore blogs',
           'force delete blogs',
           'view categories',
           'edit categories',
           'show category',
           'create categories',
           'delete categories',
           'manage users',
           'add to favorite',
           'remove from favorite',
            'show blog',
            'view favorite page'
        ];

        foreach ($permissions as $permission){
            Permission::create(['name'=>$permission]);
        }
        $adminRole=Role::create(['name'=>'admin']);
        $userRole=Role::create(['name'=>'user']);

        $adminRole->givePermissionTo(Permission::all());

        $userRole->givePermissionTo(
            'view blogs',
            'add to favorite',
            'remove from favorite',
            'show blog',
            'view favorite page',
            'view categories',
            'show category'
        );
       $adminUser = User::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Admin',
        'password' => bcrypt('password123'),
    ]
);
$adminUser->assignRole('admin');
}}
