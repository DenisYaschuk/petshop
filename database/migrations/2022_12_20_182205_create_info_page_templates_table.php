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
        Schema::create('info_page_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('component_name')->unique();
            $table->timestamps();
        });

        DB::table('info_page_templates')->insert(
            [
                [
                    'name' => 'One column template ',
                    'component_name' => 'one-column-info-page',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Two column template ',
                    'component_name' => 'two-column-info-page',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_page_templates');
    }
};
