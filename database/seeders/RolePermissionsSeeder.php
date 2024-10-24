<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['id' => 1, 'name' => 'create posts']);
        Permission::create(['id' => 2, 'name' => 'view posts']);
        Permission::create(['id' => 3, 'name' => 'edit posts']);
        Permission::create(['id' => 4, 'name' => 'delete posts']);

        Role::create(['id' => 1, 'name' => 'visitor']);
        Role::create(['id' => 2, 'name' => 'author']);
        Role::create(['id' => 3, 'name' => 'admin']);

        $visitor = Role::find(1);
        $visitor->givePermissionTo('view posts');

        $author = Role::find(2);
        $author->givePermissionTo(['view posts', 'create posts', 'edit posts']);

        $admin = Role::find(3);
        $admin->givePermissionTo(Permission::all());
    }
}
