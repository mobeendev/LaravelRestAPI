<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductPivotTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('category_id');
            $table->string('size', 255)->nullable(true);
            $table->string('color', 255)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('category_product');
    }

}
