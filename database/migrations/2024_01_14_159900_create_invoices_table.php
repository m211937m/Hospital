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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('invoice_type');
            $table->date('date');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('cascade');
            $table->foreignId('group_id')->nullable()->references('id')->on('groups')->onDelete('cascade');
            $table->decimal('price', 8 , 2)->default(0);
            $table->decimal('discount_value', 8 , 2)->default(0);
            $table->string('tax_rate');
            $table->string('tax_value');
            $table->decimal('total_with_tax', 8 , 2 )->default(0);
            $table->smallInteger('type')->default(1);//نقدي او اجل
            $table->smallInteger('invoice_status')->default(1);
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
        Schema::dropIfExists('invoices');
    }
};
