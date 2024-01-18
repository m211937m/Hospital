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
        Schema::create('fond_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('single_invoice_id')->nullable()->references('id')->on('single_invoices')->onDelete('cascade');
            $table->foreignId('receip_id')->nullable()->references('id')->on('recip_accounts')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade');
            $table->decimal('Dabit', 8 , 2)->nullable();
            $table->decimal('credit', 8 , 2)->nullable();
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
        Schema::dropIfExists('fond_accounts');
    }
};
