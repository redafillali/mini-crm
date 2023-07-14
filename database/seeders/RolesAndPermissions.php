<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissions extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        // Create Roles
        $admin = \Spatie\Permission\Models\Role::create( [ 'name' => 'admin' ] );
        $employee = \Spatie\Permission\Models\Role::create( [ 'name' => 'employee' ] );

        // Create Permissions
        $permissions = [
            'create admins',
            'view admins',
            'update admins',
            'create companies',
            'view companies',
            'update companies',
            'delete companies',
            'create invitations',
            'view invitations',
            'update invitations',
            'cancel invitations',
            'create employees',
            'view employees',
        ];

        // Assign Permissions to Admin Role
        foreach ( $permissions as $permission ) {
            \Spatie\Permission\Models\Permission::create( [ 'name' => $permission ] );
            $admin->givePermissionTo( $permission );
        }

        // Assign Permissions to Employee Role
        $employee->givePermissionTo( 'view invitations', 'update invitations', 'cancel invitations', 'view employees', 'create employees' );

    }
}
