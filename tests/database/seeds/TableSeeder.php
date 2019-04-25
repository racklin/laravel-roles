<?php

namespace Tests\database\seeds;

use Helldar\Roles\Models\Permission;
use Helldar\Roles\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\Models\User;

class TableSeeder
{
    public static function run()
    {
        $class = new self;

        $class->truncate();
        $class->create();
    }

    private function truncate()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('user_roles')->truncate();
        DB::table('role_permissions')->truncate();

        Schema::enableForeignKeyConstraints();
    }

    private function create()
    {
        $role = $this->role('baz');

        $role->permissions()->sync($this->permissions());

        $user = $this->user();

        $user->roles()->sync((array) $role->id);
    }

    private function role(string $name): Role
    {
        return Role::create(\compact('name'));
    }

    private function permissions(): array
    {
        $this->permission('qwerty');
        $this->permission('baz');

        return Permission::get()->pluck('id')->toArray();
    }

    private function permission(string $name): Permission
    {
        return Permission::create(\compact('name'));
    }

    private function user()
    {
        return User::create([
            'name'     => 'Admin',
            'email'    => 'test@example.com',
            'password' => Hash::make('qwerty'),
        ]);
    }
}