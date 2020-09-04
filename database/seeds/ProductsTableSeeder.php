<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Laptops
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Laptop 1'.$i,
                'slug' => 'laptop-1'.$i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])].' inch, '.[1,2,3][array_rand([1,2,3])] . 'TB SSD, 32GB RAM',
                'price' => rand(599, 2499) ,
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque libero nisi, auctor quis congue sed, rutrum quis neque. Cras mattis metus id varius laoreet. Nulla in mi tellus. Sed luctus velit eget augue egestas, in laoreet neque vestibulum.',
                'image' => 'https://picsum.photos/seed/'.rand(1, 999).'/540/720',
            ])->categories()->attach(1);
        }

        $product = Product::find(1);
        $product->categories()->attach(2);

        // Desktops
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Desktop 1'.$i,
                'slug' => 'desktop-1'.$i,
                'details' => [24, 25, 27][array_rand([24, 25, 27])].' inch, '.[1,2,3][array_rand([1,2,3])] . 'TB SSD, 32GB RAM',
                'price' => rand(599, 2499) ,
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque libero nisi, auctor quis congue sed, rutrum quis neque. Cras mattis metus id varius laoreet. Nulla in mi tellus. Sed luctus velit eget augue egestas, in laoreet neque vestibulum.',
                'image' => 'https://picsum.photos/seed/'.rand(1, 999).'/540/720',
            ])->categories()->attach(2);
        }

        // Phones
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Phone 1'.$i,
                'slug' => 'phone-1'.$i,
                'details' => [24, 25, 27][array_rand([24, 25, 27])].' inch, '.[1,2,3][array_rand([1,2,3])] . 'TB SSD, 32GB RAM',
                'price' => rand(599, 2499) ,
                'description' => 'Lorem '.$i.' ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque libero nisi, auctor quis congue sed, rutrum quis neque. Cras mattis metus id varius laoreet. Nulla in mi tellus. Sed luctus velit eget augue egestas, in laoreet neque vestibulum.',
                'image' => 'https://picsum.photos/seed/'.rand(1, 999).'/540/720',
            ])->categories()->attach(3);
        }
    }
}
