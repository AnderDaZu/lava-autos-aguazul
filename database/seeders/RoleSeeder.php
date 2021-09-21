<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'management',]);
        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name' => 'yard_manager']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'admin.administrators.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.administrators.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.administrators.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.administrators.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.employees.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.employees.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.employees.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.employees.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.agendas.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.agendas.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.agendas.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.agendas.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.services.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.services.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.services.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.services.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.marks.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.marks.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.marks.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.marks.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.lines.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.lines.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.lines.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.lines.destroy'])->syncRoles([$role1, $role2]);
    }
}
