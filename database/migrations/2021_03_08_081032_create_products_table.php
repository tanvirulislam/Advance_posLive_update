<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->integer('supplier');
            $table->integer('start_inventory');
            $table->integer('start_cost');
            $table->string('codeSymbology')->nullable();
            $table->integer('category')->nullable();
            $table->integer('subcategory')->nullable();
            $table->integer('unit');
            $table->integer('brand')->nullable();
            $table->integer('purchase_price');
            $table->integer('sell_price');
            $table->integer('discount');
            $table->integer('seles_id');
            $table->integer('whole_price');
            $table->integer('alert_qty')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
