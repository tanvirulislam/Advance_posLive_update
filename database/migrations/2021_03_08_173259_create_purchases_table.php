<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('code')->default(0);
            $table->integer('biller_id')->nullable();
            $table->double('grand_total');
            $table->double('discount')->nullable();
            $table->double('tax')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('due')->nullable();
            $table->text('note')->nullable();
            $table->string('documents')->nullable();
            $table->integer('import_by')->nullable();
            $table->integer('is_received')->default(0);
            $table->string('reference')->nullable();
            $table->string('purchase_date');
            $table->string('supplier_id');
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
        Schema::dropIfExists('purchases');
    }
}
