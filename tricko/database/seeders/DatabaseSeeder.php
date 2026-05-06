<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_imgs')->truncate();
        DB::table('sizes')->truncate();
        DB::table('products')->truncate();

        $products = [
            // TRICKA
            ['name' => 'Modré tričko', 'description' => 'Klasické modré tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 19.99, 'color' => 'blue', 'image' => 'images/products/modreT.png'],
            ['name' => 'Červené tričko', 'description' => 'Klasické červené tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 18.49, 'color' => 'red', 'image' => 'images/products/cerveneT.png'],
            ['name' => 'Zelené tričko', 'description' => 'Klasické zelené tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 17.99, 'color' => 'green', 'image' => 'images/products/zeleneT.png'],
            ['name' => 'Žlté tričko', 'description' => 'Klasické žlté tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 16.99, 'color' => 'yellow', 'image' => 'images/products/zlteT.png'],
            ['name' => 'Čierne tričko', 'description' => 'Klasické čierne tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 20.99, 'color' => 'black', 'image' => 'images/products/cierneT.png'],
            ['name' => 'Biele tričko', 'description' => 'Klasické biele tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 15.99, 'color' => 'white', 'image' => 'images/products/bieleT.png'],

            ['name' => 'Modré značkové tričko', 'description' => 'Značkové modré tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 29.99, 'color' => 'blue', 'image' => 'images/products/modreznackoveT.png'],
            ['name' => 'Červené značkové tričko', 'description' => 'Značkové červené tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 28.49, 'color' => 'red', 'image' => 'images/products/cerveneznackoveT.png'],
            ['name' => 'Zelené značkové tričko', 'description' => 'Značkové zelené tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 27.99, 'color' => 'green', 'image' => 'images/products/zeleneznackoveT.png'],
            ['name' => 'Žlté značkové tričko', 'description' => 'Značkové žlté tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 26.99, 'color' => 'yellow', 'image' => 'images/products/zlteznackoveT.png'],
            ['name' => 'Čierne značkové tričko', 'description' => 'Značkové čierne tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 30.99, 'color' => 'black', 'image' => 'images/products/cierneznackoveT.png'],
            ['name' => 'Biele značkové tričko', 'description' => 'Značkové biele tričko.', 'category' => 'Tricka', 'gender' => 'unisex', 'price' => 25.99, 'color' => 'white', 'image' => 'images/products/bieleznackoveT.png'],

            // MIKINY
            ['name' => 'Modrá mikina', 'description' => 'Klasická modrá mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 39.99, 'color' => 'blue', 'image' => 'images/products/modraM.png'],
            ['name' => 'Červená mikina', 'description' => 'Klasická červená mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 38.49, 'color' => 'red', 'image' => 'images/products/cervenaM.png'],
            ['name' => 'Zelená mikina', 'description' => 'Klasická zelená mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 37.99, 'color' => 'green', 'image' => 'images/products/zelenaM.png'],
            ['name' => 'Žltá mikina', 'description' => 'Klasická žltá mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 36.99, 'color' => 'yellow', 'image' => 'images/products/zltaM.png'],
            ['name' => 'Čierna mikina', 'description' => 'Klasická čierna mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 40.99, 'color' => 'black', 'image' => 'images/products/ciernaM.png'],
            ['name' => 'Biela mikina', 'description' => 'Klasická biela mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 35.99, 'color' => 'white', 'image' => 'images/products/bielaM.png'],

            ['name' => 'Modrá značková mikina', 'description' => 'Značková modrá mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 49.99, 'color' => 'blue', 'image' => 'images/products/modraznackovaM.png'],
            ['name' => 'Červená značková mikina', 'description' => 'Značková červená mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 48.49, 'color' => 'red', 'image' => 'images/products/cervenaznackovaM.png'],
            ['name' => 'Zelená značková mikina', 'description' => 'Značková zelená mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 47.99, 'color' => 'green', 'image' => 'images/products/zelenaznackovaM.png'],
            ['name' => 'Žltá značková mikina', 'description' => 'Značková žltá mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 46.99, 'color' => 'yellow', 'image' => 'images/products/zltaznackovaM.png'],
            ['name' => 'Čierna značková mikina', 'description' => 'Značková čierna mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 50.99, 'color' => 'black', 'image' => 'images/products/ciernaznackovaM.png'],
            ['name' => 'Biela značková mikina', 'description' => 'Značková biela mikina.', 'category' => 'Mikiny', 'gender' => 'unisex', 'price' => 45.99, 'color' => 'white', 'image' => 'images/products/bielaznackovaM.png'],

            // CIAPKY
            ['name' => 'Modrá čiapka', 'description' => 'Klasická modrá čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 12.99, 'color' => 'blue', 'image' => 'images/products/modraC.png'],
            ['name' => 'Červená čiapka', 'description' => 'Klasická červená čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 11.49, 'color' => 'red', 'image' => 'images/products/cervenaC.png'],
            ['name' => 'Zelená čiapka', 'description' => 'Klasická zelená čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 10.99, 'color' => 'green', 'image' => 'images/products/zelenaC.png'],
            ['name' => 'Žltá čiapka', 'description' => 'Klasická žltá čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 9.99, 'color' => 'yellow', 'image' => 'images/products/zltaC.png'],
            ['name' => 'Čierna čiapka', 'description' => 'Klasická čierna čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 13.99, 'color' => 'black', 'image' => 'images/products/ciernaC.png'],
            ['name' => 'Biela čiapka', 'description' => 'Klasická biela čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 8.99, 'color' => 'white', 'image' => 'images/products/bielaC.png'],

            ['name' => 'Modrá značková čiapka', 'description' => 'Značková modrá čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 18.99, 'color' => 'blue', 'image' => 'images/products/modraznackovaC.png'],
            ['name' => 'Červená značková čiapka', 'description' => 'Značková červená čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 17.49, 'color' => 'red', 'image' => 'images/products/cervenaznackovaC.png'],
            ['name' => 'Zelená značková čiapka', 'description' => 'Značková zelená čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 16.99, 'color' => 'green', 'image' => 'images/products/zelenaznackovaC.png'],
            ['name' => 'Žltá značková čiapka', 'description' => 'Značková žltá čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 15.99, 'color' => 'yellow', 'image' => 'images/products/zltaznackovaC.png'],
            ['name' => 'Čierna značková čiapka', 'description' => 'Značková čierna čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 19.99, 'color' => 'black', 'image' => 'images/products/ciernaznackovaC.png'],
            ['name' => 'Biela značková čiapka', 'description' => 'Značková biela čiapka.', 'category' => 'Ciapky', 'gender' => 'unisex', 'price' => 14.99, 'color' => 'white', 'image' => 'images/products/bielaznackovaC.png'],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'description' => $product['description'],
                'category' => $product['category'],
                'gender' => $product['gender'],
                'price' => $product['price'],
                'color' => $product['color'],
                'image' => $product['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $allProducts = DB::table('products')->get();

        foreach ($allProducts as $product) {
            if ($product->category === 'Tricka' || $product->category === 'Mikiny') {
                DB::table('sizes')->insert([
                    ['size' => 'S', 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()],
                    ['size' => 'M', 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()],
                    ['size' => 'L', 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()],
                    ['size' => 'XL', 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()],
                ]);
            } else {
                DB::table('sizes')->insert([
                    ['size' => 'UNI', 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()],
                ]);
            }

            DB::table('product_imgs')->insert([
                'product_id' => $product->id,
                'image' => $product->image,
                'order_number' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@admin.sk'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $adminUserId = DB::table('users')
            ->where('email', 'admin@admin.sk')
            ->value('id');

        DB::table('admins')->updateOrInsert(
            ['user_id' => $adminUserId],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
