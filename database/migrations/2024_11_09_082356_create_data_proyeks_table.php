<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_proyeks', function (Blueprint $table) {
            $table->id(); 
            $table->dateTime('tanggal')->nullable();
            $table->string('no_rekening', 100)->nullable();
            $table->string('attechment', 100)->nullable();
            $table->string('d', 50)->nullable();
            $table->string('k', 50)->nullable();
            $table->string('s', 50)->nullable();
            $table->string('code1', 50)->nullable();
            $table->string('code2', 50)->nullable();
            $table->string('penerima', 50)->nullable();
            $table->string('pemberi', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_proyeks');
    }
};
