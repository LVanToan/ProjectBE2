<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnsOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('returns_order')->insert([
            [
                'user_id'              => 1,
                'orders_id'            => 1234,
                'product_id'           => 1,
                'status_product'       => 'damaged',
                'return_reason'        => 'Sản phẩm bị lỗi',
                'detailed_description' => 'Sản phẩm bị vỡ trong quá trình vận chuyển.',
                'image_1'              => 'image1.jpg',
                'image_2'              => 'image2.jpg',
                'banking_id'           => 1,
                'phone'                => '0123456789',
                'status'               => 'pending',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'user_id'              => 2,
                'orders_id'            => 5678,
                'product_id'           => 2,
                'status_product'       => 'wrong_item',
                'return_reason'        => 'Giao sai sản phẩm',
                'detailed_description' => 'Khách hàng nhận được sản phẩm không đúng với đơn đặt hàng.',
                'image_1'              => 'image3.jpg',
                'image_2'              => 'image4.jpg',
                'banking_id'           => 2,
                'phone'                => '0987654321',
                'status'               => 'approved',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'user_id'              => 3,
                'orders_id'            => 7892,
                'product_id'           => 3,
                'status_product'       => 'damaged',
                'return_reason'        => 'Sản phẩm bị hỏng',
                'detailed_description' => 'Sản phẩm bị hỏng hoàn toàn không thể sử dụng.',
                'image_1'              => 'image5.jpg',
                'image_2'              => 'image6.jpg',
                'banking_id'           => 3,
                'phone'                => '0912345678',
                'status'               => 'rejected',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'user_id'              => 4,
                'orders_id'            => 9012,
                'product_id'           => 4,
                'status_product'       => 'wrong_size',
                'return_reason'        => 'Kích thước không phù hợp',
                'detailed_description' => 'Sản phẩm không đúng kích thước như mô tả.',
                'image_1'              => 'image7.jpg',
                'image_2'              => 'image8.jpg',
                'banking_id'           => 4,
                'phone'                => '0934567890',
                'status'               => 'pending',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}
