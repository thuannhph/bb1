<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vips', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('vips_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('vips_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'vips_id'], 'vips_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vips');
        Schema::dropIfExists('vips_translations');
    }
};
