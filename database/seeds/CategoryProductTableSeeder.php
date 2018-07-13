<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $products = \App\Product::all();
        //Categories that don't have child categories.
        $categories = \App\Category::where('id', '!=', 'sub_category_id')->get();
        $colors = array("red", "green", "blue", "yellow", "brown");
        $sizes = array("Small","Medium","Large");
        foreach ($products as $product) {
        $color_index = array_rand($colors, 1);
        $size_index = array_rand($sizes, 1);
            DB::table('category_product')->insert([
                'category_id' => $categories->random()->id,
                'product_id' => $product->id,
                'product_id' => $product->id,
                'color' => $colors[$color_index],
                'size' => $sizes[$size_index],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }

}
