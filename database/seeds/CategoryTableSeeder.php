<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /**
         * We are going to insert 100 categories.
         */
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table('categories')->insert([
                'name' => implode($faker->words(), ' '),
                'sub_category_id' => (($i % 2) === 0) ? $this->get_random_category_id() : null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }

    private function get_random_category_id() {
        $random_category = \App\Category::inRandomOrder()->first();
        return !is_null($random_category) ? $random_category->id : null;
    }

}
