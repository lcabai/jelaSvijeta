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
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meal_id');
            $table->string('locale')->index();
            $table->unique(['meal_id', 'locale']);
            $table->string('title');
            $table->text('description')->nullable();

            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('locale')->references('locale')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_translations');
    }
};
