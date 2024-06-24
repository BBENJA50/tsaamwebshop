<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('parent_id');
            $table->string('parent_name');
            $table->unsignedBigInteger('child_id');
            $table->string('child_name');
            $table->decimal('total_price', 10, 2);
            $table->string('payment_intent_id')->nullable();
            $table->timestamp('ordered_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
