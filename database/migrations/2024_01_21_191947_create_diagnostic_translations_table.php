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
        Schema::create('diagnostic_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->longText('diagnostic');
            $table->longText('medicine');
            $table->unique(['diagnostic_id','locale']);
            $table->foreignId('diagnostic_id')->references('id')->on('diagnostics')->onDelete('cascade');
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
        Schema::dropIfExists('diagnostic_translations');
    }
};
