<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\UsersRepository;
use App\Repositories\RolesRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\User;
use App\Role;

class LaravelBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('permission_groups')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('auth_logs')->truncate();
        DB::table('user_blacklists')->truncate();

        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
                'display_name' => 'Admin',
                'description' => 'Administrador de sistema.'
            ]
        ];

        foreach ($roles as $roleData) {
            RolesRepository::create(new Role, $roleData);
        }

        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'admin',
                'is_active' => true
            ]
        ];

        foreach ($users as $userData) {
            $userData['password'] = app()->make('hash')->make($userData['password']);
            $user = UsersRepository::create(new User, $userData);
        }

        User::find(1)->attachRole(1);

        $permissionGroups = [
            [
                'name' => 'Logs de autentificación'
            ],
            [
                'name' => 'Permisos y Roles'
            ],
            [
                'name' => 'Usuarios'
            ],
        ];

        foreach ($permissionGroups as $permissionGroupData) {
            PermissionGroupsRepository::create(new PermissionGroup, $permissionGroupData);
        }

        $permissions = [
            ['1', 'AuthLog:List', 'Logs de autentificación'],
            ['2', 'PermissionGroup:List', 'Lista Grupos de Permisos'],
            ['2', 'Permission:List', 'Lista de permisos'],
            ['2', 'Role:List', 'Lista de Roles'],
            ['2', 'Role:Show', 'Ver Detalle de Roles'],
            ['2', 'Role:Create', 'Crear Nuevo Rol'],
            ['2', 'Role:Update', 'Actualizar rol existente'],
            ['2', 'Role:Duplicate', 'Duplicar rol existente'],
            ['2', 'Role:Revisions', 'Ver la revision del rol'],
            ['2', 'Role:Delete', 'Eliminar rol'],
            ['3', 'User:List', 'Listar usuario'],
            ['3', 'User:Show', 'Ver detalle de usuarios'],
            ['3', 'User:Create', 'Crear nuevo usuario'],
            ['3', 'User:Update', 'Actualizar usuario'],
            ['3', 'User:Duplicate', 'Duplicar usuario existente'],
            ['3', 'User:Revisions', 'Ver revision de usuarios'],
            ['3', 'User:Delete', 'Eliminar usuario'],
            ['3', 'User:Assume', 'Ingresar con otro usuario'],
            ['3', 'User:Activate', 'Cambiar usuario Activo / Inactivo'],
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission, [
                'permission_group_id' => $permissionData[0],
                'name' => $permissionData[1],
                'display_name' => $permissionData[2],
            ]);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup, ['name' => 'User Blacklists']);

        $permissionGroup->permissions()->saveMany(array_map(function($permissionData){
            return new Permission($permissionData);
        }, [
            ['name' => 'UserBlacklist:List', 'display_name' => 'Lista negra de usuarios'],
            ['name' => 'UserBlacklist:Show', 'display_name' => 'Ver detalles de la lista negra de usuarios'],
            ['name' => 'UserBlacklist:Create', 'display_name' => 'Crear nueva lista negra de usuarios'],
            ['name' => 'UserBlacklist:Update', 'display_name' => 'Actualizar lista negra de usuarios'],
            ['name' => 'UserBlacklist:Duplicate', 'display_name' => 'Duplicar lista negra de usuarios'],
            ['name' => 'UserBlacklist:Revisions', 'display_name' => 'Ver revisiones de la lista negra '],
            ['name' => 'UserBlacklist:Delete', 'display_name' => 'Eliminar la Lista negra de usuarios'],
        ]));

    }
}
