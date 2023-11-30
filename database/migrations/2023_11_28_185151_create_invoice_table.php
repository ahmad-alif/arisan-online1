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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('uuid');
            $table->unsignedBigInteger('id_user');
            $table->string('nama_bank');
            $table->string('no_rekening');
            $table->string('nama_pemilik_rekening');
            $table->string('total');
            $table->integer('status');
            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
