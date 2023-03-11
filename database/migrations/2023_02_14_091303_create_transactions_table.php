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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('branch_to');
            $table->integer('product_id');
            $table->integer('transaction_type')->comment('1:credt,0:debit');
            $table->integer('qty');
            $table->string('log');
            $table->integer('created_by');
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
        Schema::dropIfExists('transactions');
    }
};
