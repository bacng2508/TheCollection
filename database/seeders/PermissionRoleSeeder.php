<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert(
            [
                ['role_id' => 1, 'permission_id' => $permission->id],
            ]
        );
        }
        
    }
}
