<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('branch_id');
            $table->integer('qty');
            $table->integer('mrp');
            $table->integer('court_fees');
            $table->integer('tcs');
            $table->integer('total_amount');
            $table->integer('created_by');
            $table->date('invoice_date');
            $table->integer('status')->nullable()->default(1)->comment('1:active,0:inactive');
            $table->integer('is_deleted')->nullable()->default(0)->comment('1:active,0:inactive');
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
};
