<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            AttributeSeeder::class,
            AttributeOptionSeeder::class,
            ProductSeeder::class,
            ProductAttributeSeeder::class,
            RoleSeeder::class,
            PermissionGroupSeeder::class,
            PermissionSeeder::class,
            AdministratorSeeder::class,
            AdministratorRoleSeeder::class,
            PermissionRoleSeeder::class,
            UserSeeder::class,
            CouponSeeder::class,
            ReviewSeeder::class
        ]);
    }
}
