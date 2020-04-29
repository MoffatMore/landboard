<?php

use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;

    class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // this can be done as separate statements
        Role::create(['name' => 'customer']);

        // or may be done by chaining
        Role::create(['name' => 'admin']);
    }
}
