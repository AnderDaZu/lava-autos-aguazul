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
        $role4 = Role::create(['name' => 'employee']);
        $role5 = Role::create(['name' => 'user']); 

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'admin.administrators.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.administrators.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.administrators.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.administrators.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.yardManagers.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.yardManagers.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.yardManagers.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.yardManagers.destroy'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.employees.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.employees.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.employees.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.employees.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.agendas.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.agendas.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.agendas.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.agendas.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.services.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.services.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.services.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.services.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.marks.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.marks.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.marks.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.marks.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.modelcars.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.modelcars.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.modelcars.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.modelcars.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.types.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.types.destroy'])->syncRoles([$role1]);

        // Usuarios - Clientes 

        Permission::create(['name' => 'user.appointments.index'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.appointments.vehicles'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.appointments.services'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.appointments.spaces'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.appointments.employees'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.appointments.store'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.vehicles.index'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.vehicles.create'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.vehicles.show'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.vehicles.update'])->syncRoles([$role5]);
        Permission::create(['name' => 'user.rating.store'])->syncRoles();


        // Jefes de patio

        Permission::create(['name' => 'yard.appointments.index'])->syncRoles([$role3]);
        Permission::create(['name' => 'yard.tasks-finished'])->syncRoles($role3);
        Permission::create(['name' => 'yard.tasks.index'])->syncRoles($role3);
        Permission::create(['name' => 'yard.tasks.show'])->syncRoles($role3);
        Permission::create(['name' => 'yard.tasks.store'])->syncRoles($role3);
        Permission::create(['name' => 'yard.tasks.update'])->syncRoles($role3);
        Permission::create(['name' => 'yard.unscheduledtasks.index'])->syncRoles($role3);
        Permission::create(['name' => 'yard.unscheduledtasks.types'])->syncRoles($role3);
        Permission::create(['name' => 'yard.unscheduledtasks.employees'])->syncRoles($role3);
        Permission::create(['name' => 'yard.unscheduledtasks.show'])->syncRoles($role3);
        Permission::create(['name' => 'yard.unscheduledtasks.store'])->syncRoles($role3);
        // Permission::create(['name' => ''])->syncRoles();

        
        // Empleado

        Permission::create(['name' => 'employee.tasks'])->syncRoles($role4);
        Permission::create(['name' => 'employee.tasks.scheduled'])->syncRoles($role4);
        Permission::create(['name' => 'employee.tasks.unscheduled'])->syncRoles($role4);

    }
}
