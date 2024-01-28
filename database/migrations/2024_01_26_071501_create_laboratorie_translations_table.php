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
        Schema::create('laboratorie_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->longText('description');
            $table->unique(['description','locale']);
            $table->foreignId('laboratorie_id')->references('id')->on('laboratories')->onDelete('cascade');
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
        Schema::dropIfExists('laboratorie_translations');
    }
};
