<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_groups')->insert(
            [
                [
                    'name' => 'category',
                    'display_name' => 'Danh mục'
                ],
                [
                    'name' => 'brand',
                    'display_name' => 'Thương hiệu'
                ],
                [
                    'name' => 'attribute',
                    'display_name' => 'Thuộc tính'
                ],
                [
                    'name' => 'attribute-option',
                    'display_name' => 'Giá trị thuộc tính'
                ],
                [
                    'name' => 'product',
                    'display_name' => 'Sản phẩm'
                ],
                [
                    'name' => 'coupon',
                    'display_name' => 'Coupon'
                ],
                [
                    'name' => 'order',
                    'display_name' => 'Đơn hàng'
                ],
                [
                    'name' => 'review',
                    'display_name' => 'Đánh giá'
                ],
                [
                    'name' => 'role',
                    'display_name' => 'Role'
                ],
                [
                    'name' => 'administrator',
                    'display_name' => 'Quản trị viên'
                ],
                [
                    'name' => 'client',
                    'display_name' => 'Khách hàng'
                ]

            ]
        );
    }
}
