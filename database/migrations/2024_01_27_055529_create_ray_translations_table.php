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
        Schema::create('ray_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->longText('descriptio');
            $table->longText('descriptio_employee')->nullable();
            $table->unique(['descriptio','locale']);
            $table->foreignId('ray_id')->references('id')->on('rays')->onDelete('cascade');
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
        Schema::dropIfExists('ray_translations');
    }
};
