<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);

        $permissionGroups = [
            'category' =>[
                'category.create',
                'category.view',
                'category.edit',
                'category.delete',
            ],    
            'post' =>[
                'post.create',
                'post.view',
                'post.edit',
                'post.delete',
                'post.approve',
            ],  
            'user' =>[
                'user.create',
                'user.view',
                'user.delete',
            ],
            'profile' =>[
                'profile.view',
                'profile.edit',
                'profile.delete',
            ],
        ];

        $userPermissions = [
            'profile.view',
            'profile.edit',
            'profile.delete',
            'post.create',
            'post.view',
            'post.edit',
            'post.delete',
        ];

        foreach($permissionGroups as $permissionGroupkey => $permissionGroup){
            foreach($permissionGroup as $permissionName){
                $permission = Permission::create([
                    'name'          => $permissionName,
                ]);

                $admin_role->givePermissionTo($permission);
                $permission->assignRole($admin_role);

                if(in_array($permissionName,  $userPermissions)){
                    $user_role->givePermissionTo($permission);
                    $permission->assignRole($user_role);
                }
            }
        }

        
    }
}
