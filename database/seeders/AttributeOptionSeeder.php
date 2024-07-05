<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('attribute_options')->insert(
            [
                [
                    'value' => 'Nhật Bản',
                    'slug' => Str::slug('Nhật Bản'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Xuất sứ')->value('id')
                ],
                [
                    'value' => 'Thụy Sỹ',
                    'slug' => Str::slug('Thụy Sỹ'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Xuất sứ')->value('id')
                ],
                [
                    'value' => 'Thụy Điển',
                    'slug' => Str::slug('Thụy Điển'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Xuất sứ')->value('id')
                ],
                [
                    'value' => 'Anh',
                    'slug' => Str::slug('Anh'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Xuất sứ')->value('id')
                ],
                [
                    'value' => '2 năm',
                    'slug' => Str::slug('2 năm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Bảo hành')->value('id')
                ],
                [
                    'value' => '3 năm',
                    'slug' => Str::slug('3 năm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Bảo hành')->value('id')
                ],
                [
                    'value' => '5 năm',
                    'slug' => Str::slug('5 năm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Bảo hành')->value('id')
                ],
                [
                    'value' => 'Quartz (Pin)',
                    'slug' => Str::slug('Quartz (Pin)'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Máy')->value('id')
                ],
                [
                    'value' => 'Cơ',
                    'slug' => Str::slug('Cơ'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Máy')->value('id')
                ],
                [
                    'value' => 'Kính cứng',
                    'slug' => Str::slug('Kính cứng'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Kính')->value('id')
                ],
                [
                    'value' => 'Kính nhựa',
                    'slug' => Str::slug('Kính nhựa'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Kính')->value('id')
                ],
                [
                    'value' => 'Kính Sapphire',
                    'slug' => Str::slug('Kính Sapphire'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Kính')->value('id')
                ],
                [
                    'value' => '40.2 mm',
                    'slug' => Str::slug('40.2 mm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Đường kính mặt số')->value('id')
                ],
                [
                    'value' => '41.7 mm',
                    'slug' => Str::slug('41.7 mm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Đường kính mặt số')->value('id')
                ],
                [
                    'value' => '42.5 mm',
                    'slug' => Str::slug('42.5 mm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Đường kính mặt số')->value('id')
                ],
                [
                    'value' => '5 mm',
                    'slug' => Str::slug('5 mm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Bề dày mặt số')->value('id')
                ],
                [
                    'value' => '7 mm',
                    'slug' => Str::slug('7 mm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Bề dày mặt số')->value('id')
                ],
                [
                    'value' => '8 mm',
                    'slug' => Str::slug('8 mm'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Bề dày mặt số')->value('id')
                ],
                [
                    'value' => 'Dây nhựa',
                    'slug' => Str::slug('Dây nhựa'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Dây đeo')->value('id')
                ],
                [
                    'value' => 'Dây vải',
                    'slug' => Str::slug('Dây vải'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Dây đeo')->value('id')
                ],
                [
                    'value' => 'Dây kim loại',
                    'slug' => Str::slug('Dây kim loại'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Dây đeo')->value('id')
                ],
                [
                    'value' => 'Đi mưa nhỏ(3 ATM)',
                    'slug' => Str::slug('Đi mưa nhỏ(3 ATM)'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Chống nước')->value('id')
                ],
                [
                    'value' => 'Đi tắm(5 ATM)',
                    'slug' => Str::slug('Đi tắm(5 ATM)'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Chống nước')->value('id')
                ],
                [
                    'value' => 'Đi bơi(10 ATM)',
                    'slug' => Str::slug('Đi bơi(10 ATM)'),
                    'attribute_id' => DB::table('attributes')->where('name', 'Chống nước')->value('id')
                ],
            ]
        );
    }
}
