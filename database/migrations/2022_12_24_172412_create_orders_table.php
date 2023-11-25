<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal');
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('city');
            $table->string('province');
            $table->string('zipcode');
            $table->string('address');
            $table->enum('status', ['ordered', 'delivered', 'canceled'])->default('ordered');
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
        Schema::dropIfExists('orders');
    }
};
