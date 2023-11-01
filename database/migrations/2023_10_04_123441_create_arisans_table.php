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
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigint('id_user');
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
