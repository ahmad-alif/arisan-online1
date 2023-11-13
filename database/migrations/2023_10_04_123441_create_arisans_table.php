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
        Schema::create('arisans', function (Blueprint $table) {
            $table->id('id_arisan');
            $table->string('nama_arisan');
            $table->string('img_arisan');
            $table->text('deskripsi');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigint('id_user');
            $table->integer('status');
            $table->integer('active');
            $table->integer('max_member');
            $table->string('deposit_frequency');
            $table->string('payment_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arisans');
    }
};
