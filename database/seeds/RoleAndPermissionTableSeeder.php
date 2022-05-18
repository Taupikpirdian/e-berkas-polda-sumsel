<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeder role and permission seeder dimulai ... ";
        echo "\n";
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        echo "create permissions users";
        echo "\n";
        // create permissions users
        $check_permission = Permission::where(['name' => 'list users'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'list users']);
        }
        $check_permission = Permission::where(['name' => 'edit user'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'edit user']);
        }
        $check_permission = Permission::where(['name' => 'delete user'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'delete user']);
        }

        echo "create permissions roles";
        echo "\n";
        // create permissions roles
        $check_permission = Permission::where(['name' => 'list roles'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'list roles']);
        }
        $check_permission = Permission::where(['name' => 'edit role'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'edit role']);
        }
        $check_permission = Permission::where(['name' => 'delete role'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'delete role']);
        }

        echo "create permissions permissions";
        echo "\n";
        // create permissions permissions
        $check_permission = Permission::where(['name' => 'list permissions'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'list permissions']);
        }
        $check_permission = Permission::where(['name' => 'edit permission'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'edit permission']);
        }
        $check_permission = Permission::where(['name' => 'delete permission'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'delete permission']);
        }

        echo "create permissions master-datas";
        echo "\n";
        // create permissions master-datas
        $check_permission = Permission::where(['name' => 'list master-datas'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'list master-datas']);
        }
        $check_permission = Permission::where(['name' => 'edit master-data'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'edit master-data']);
        }
        $check_permission = Permission::where(['name' => 'delete master-data'])->first();
        if (!$check_permission) {
            Permission::create(['name' => 'delete master-data']);
        }

        echo "create roles and assign created permissions admin-master";
        echo "\n";
        // admin-master
        $check_role = Role::where(['name' => 'admin-master'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'admin-master']);
            $role->givePermissionTo(Permission::all());
        }
        echo "create roles and assign created permissions admin";
        echo "\n";

        // admin
        $check_role = Role::where(['name' => 'admin'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'admin']);
            $role->givePermissionTo([
                'list users',
                'edit user',
                'delete user',
                'list master-datas',
                'edit master-data',
                'delete master-data'
            ]);
        }

        // kepolisian
        $check_role = Role::where(['name' => 'kepolisian'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'kepolisian']);
        }

        // kepolisian admin
        $check_role = Role::where(['name' => 'admin-kepolisian'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'admin-kepolisian']);
        }

        // kejaksaan admin
        $check_role = Role::where(['name' => 'admin-kejaksaan'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'admin-kejaksaan']);
        }

        // kejaksaan
        $check_role = Role::where(['name' => 'kejaksaan'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'kejaksaan']);
        }

        // pengadilan
        $check_role = Role::where(['name' => 'pengadilan'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'pengadilan']);
        }

        // admin lapas
        $check_role = Role::where(['name' => 'admin-lapas'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'admin-lapas']);
        }

        // lapas
        $check_role = Role::where(['name' => 'lapas'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'lapas']);
        }

        // operator Oharda
        $check_role = Role::where(['name' => 'operator-01'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'operator-01']);
        }
        // Kamneg/Tibum/TPUL
        $check_role = Role::where(['name' => 'operator-02'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'operator-02']);
        }
        // Narkotika
        $check_role = Role::where(['name' => 'operator-03'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'operator-03']);
        }
        // Terorisme dan TPPU
        $check_role = Role::where(['name' => 'operator-04'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'operator-04']);
        }
        // kasi pidum
        $check_role = Role::where(['name' => 'operator-kasi-pidum'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'operator-kasi-pidum']);
        }
        // kasi pidsus
        $check_role = Role::where(['name' => 'operator-kasi-pidsus'])->first();
        if (!$check_role) {
            $role = Role::create(['name' => 'operator-kasi-pidsus']);
        }

        echo "Proses seeder selesai. Terimakasih DevOps...";
        echo "\n";
    }
}
