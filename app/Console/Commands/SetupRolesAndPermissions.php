<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class SetupRolesAndPermissions extends Command
{
    protected $signature = 'setup:roles-permissions';
    protected $description = 'Create roles and assign permissions for admin, visitor, and author with manual IDs';

    public function handle()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Permission::truncate();
        // Role::truncate();

        $permissions = [
            ['id' => 1, 'name' => 'view posts', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'create posts', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'edit posts', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'delete posts', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'approve posts', 'guard_name' => 'web'],
        ];

        Permission::insert($permissions);

        $roles = [
            ['id' => 1, 'name' => 'visitor', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'author', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'admin', 'guard_name' => 'web'],
        ];

        Role::insert($roles);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $visitor = Role::find(1);
        $visitor->givePermissionTo('view posts');

        $author = Role::find(2);
        $author->givePermissionTo(['view posts', 'create posts', 'edit posts']);

        $admin = Role::find(3);
        $admin->givePermissionTo(Permission::all());

        $this->info('Roles and permissions have been set up successfully with manual IDs!');
    }
}
