<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->text('values');
            $table->timestamps();
        });

        DB::table('menus')->insert(
            [
                'values' => json_encode([
                   '1' => [
                       'name' => 'Home',
                       'link' => '/',
                   ],
                    '2' => [
                        'name' => 'Shop',
                        'link' => '/shop',
                    ],
                ]),
            ],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
