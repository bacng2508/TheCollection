<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert(
            [
                [
                    'name' => 'list-category',
                    'display_name' => 'Xem danh mục',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'category')->value('id')
                ],
                [
                    'name' => 'add-category',
                    'display_name' => 'Thêm danh mục',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'category')->value('id')
                ],
                [
                    'name' => 'edit-category',
                    'display_name' => 'Sửa danh mục',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'category')->value('id')
                ],
                [
                    'name' => 'delete-category',
                    'display_name' => 'Xóa danh mục',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'category')->value('id')
                ],
                [
                    'name' => 'list-brand',
                    'display_name' => 'Xem thương hiệu',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'brand')->value('id')
                ],
                [
                    'name' => 'add-brand',
                    'display_name' => 'Thêm thương hiệu',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'brand')->value('id')
                ],
                [
                    'name' => 'edit-brand',
                    'display_name' => 'Sửa thương hiệu',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'brand')->value('id')
                ],
                [
                    'name' => 'delete-brand',
                    'display_name' => 'Xóa thương hiệu',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'brand')->value('id')
                ],
                [
                    'name' => 'list-attribute',
                    'display_name' => 'Xem thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute')->value('id')
                ],
                [
                    'name' => 'add-attribute',
                    'display_name' => 'Thêm thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute')->value('id')
                ],
                [
                    'name' => 'edit-attribute',
                    'display_name' => 'Sửa thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute')->value('id')
                ],
                [
                    'name' => 'delete-attribute',
                    'display_name' => 'Xóa thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute')->value('id')
                ],
                [
                    'name' => 'list-attribute-option',
                    'display_name' => 'Xem giá trị thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute-option')->value('id')
                ],
                [
                    'name' => 'add-attribute-option',
                    'display_name' => 'Thêm giá trị thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute-option')->value('id')
                ],
                [
                    'name' => 'edit-attribute-option',
                    'display_name' => 'Sửa giá trị thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute-option')->value('id')
                ],
                [
                    'name' => 'delete-attribute-option',
                    'display_name' => 'Xóa giá trị thuộc tính',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'attribute-option')->value('id')
                ],
                [
                    'name' => 'list-product',
                    'display_name' => 'Xem sản phẩm',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'product')->value('id')
                ],
                [
                    'name' => 'add-product',
                    'display_name' => 'Thêm sản phẩm',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'product')->value('id')
                ],
                [
                    'name' => 'edit-product',
                    'display_name' => 'Sửa sản phẩm',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'product')->value('id')
                ],
                [
                    'name' => 'delete-product',
                    'display_name' => 'Xóa sản phẩm',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'product')->value('id')
                ],
                [
                    'name' => 'active-feature-product',
                    'display_name' => 'Active sản phẩm nổi bật',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'product')->value('id')
                ],
                [
                    'name' => 'list-coupon',
                    'display_name' => 'Xem coupon',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'coupon')->value('id')
                ],
                [
                    'name' => 'add-coupon',
                    'display_name' => 'Thêm coupon',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'coupon')->value('id')
                ],
                [
                    'name' => 'edit-coupon',
                    'display_name' => 'Sửa coupon',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'coupon')->value('id')
                ],
                [
                    'name' => 'delete-coupon',
                    'display_name' => 'Xóa coupon',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'coupon')->value('id')
                ],
                [
                    'name' => 'list-order',
                    'display_name' => 'Xem đơn hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'order')->value('id')
                ],
                [
                    'name' => 'detail-order',
                    'display_name' => 'Chi tiết đơn hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'order')->value('id')
                ],
                [
                    'name' => 'status-order',
                    'display_name' => 'Thay đổi trạng thái',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'order')->value('id')
                ],
                [
                    'name' => 'list-review',
                    'display_name' => 'Xem đánh giá',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'review')->value('id')
                ],
                [
                    'name' => 'status-review',
                    'display_name' => 'Ẩn/hiện',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'review')->value('id')
                ],
                [
                    'name' => 'list-role',
                    'display_name' => 'Xem role',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'role')->value('id')
                ],
                [
                    'name' => 'add-role',
                    'display_name' => 'Thêm role',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'role')->value('id')
                ],
                [
                    'name' => 'edit-role',
                    'display_name' => 'Sửa role',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'role')->value('id')
                ],
                [
                    'name' => 'delete-role',
                    'display_name' => 'Xóa role',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'role')->value('id')
                ],
                [
                    'name' => 'authorize-role',
                    'display_name' => 'Phân quyền role',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'role')->value('id')
                ],
                [
                    'name' => 'list-administrator',
                    'display_name' => 'Xem quản trị viên',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'administrator')->value('id')
                ],
                [
                    'name' => 'add-administrator',
                    'display_name' => 'Thêm quản trị viên',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'administrator')->value('id')
                ],
                [
                    'name' => 'edit-administrator',
                    'display_name' => 'Sửa quản trị viên',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'administrator')->value('id')
                ],
                [
                    'name' => 'delete-administrator',
                    'display_name' => 'Xóa quản trị viên',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'administrator')->value('id')
                ],
                [
                    'name' => 'status-administrator',
                    'display_name' => 'Thay đổi trạng thái',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'administrator')->value('id')
                ],
                [
                    'name' => 'list-client',
                    'display_name' => 'Xem khách hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'client')->value('id')
                ],
                [
                    'name' => 'add-client',
                    'display_name' => 'Thêm khách hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'client')->value('id')
                ],
                [
                    'name' => 'edit-client',
                    'display_name' => 'Sửa khách hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'client')->value('id')
                ],
                [
                    'name' => 'delete-client',
                    'display_name' => 'Xóa khách hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'client')->value('id')
                ],
                [
                    'name' => 'status-client',
                    'display_name' => 'Thay đổi trạng thái',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'client')->value('id')
                ],
                [
                    'name' => 'export-client',
                    'display_name' => 'Xuất dữ liệu khách hàng',
                    'permission_group_id' => DB::table('permission_groups')->where('name', 'client')->value('id')
                ],
            ]
        );
    }
}
