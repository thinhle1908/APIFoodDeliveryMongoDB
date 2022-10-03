<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => "Buno Xao",
            'price' => 67000,
            'image' => "bunboxao.png",
            'qty' => 10,
            'description' => "Vô cùng đơn giản và nhanh chóng để chúng ta có thể làm nên món Bún bò xào, nước mắm chua ngọt cực thơm ngon. Cảm nhận sự đậm đà của hương vị, nhẹ nhàng của nước mắm chua ngọt, kết hợp cùng phần thịt bò xào hành chất lượng và không thể thiếu sự tươi mát của phần rau sống ăn kèm. Còn gì tuyệt vời hơn việc lựa chọn món ăn này để chiêu đãi người thân trong gia đình vào những ngày cuối tuần, vừa mới lạ, vừa hấp dẫn, ngon miệng.",
            'visible' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => "Lau Thai",
            'price' => 249000,
            'image' => "lauthai.png",
            'qty' => 10,
            'visible' => 1,
            'description' => "Lẩu Thái hay được gọi đơn giản là lẩu ở Thái Lan, là một biến thể của món lẩu ở Thái Lan và cũng là một trong những đặc sản và là món ăn truyền thống của xứ này. Lẩu Thái về cơ bản là một món ăn nóng, thực khách nhúng thịt, hải sản, mì và rau vào nồi nước dùng nấu ăn tại bàn và nhúng nó một hỗn hợp trước khi ăn.",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => "Banh canh suon",
            'price' => 73000,
            'image' => "banhcanhsuon.png",
            'qty' => 10,
            'visible' => 1,
            'description' => "Miền Trung vốn nổi tiếng là nơi có rất nhiều các món bánh canh ngon hấp dẫn. Sợi bánh canh trắng đục, dai dai hoà quyện cùng với vị ngọt tự nhiên của nước dùng. Khiến ai ăn rồi cũng đều nhớ mãi không quên. Hãy cùng Digifood vào bếp trổ tài với cách nấu bánh canh sườn heo chuẩn vị miền Trung này nhé! ",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => "Suon nuong la chanh",
            'price' => 169000,
            'image' => "suonnuonglachanh.png",
            'qty' => 10,
            'visible' => 1,
            'description' => "Những miếng sườn sốt lá chanh thơm nức, đậm đà, chan ít sốt sườn lên bát cơm nóng hổi thì ngon không gì sánh bằng.",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'product_name' => "Cha gio",
            'price' => 79000,
            'image' => "chagio.png",
            'qty' => 10,
            'visible' => 1,
            'description' => "Chả giò là một món chiên thơm ngon quen thuộc với hương vị cũng như cách chế biến đa dạng và phong phú.",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
