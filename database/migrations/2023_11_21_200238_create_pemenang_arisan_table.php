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
        Schema::create('pemenang_arisan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_arisan')->unsigned();
            $table->string('uuid');
            $table->bigInteger('id_user')->unsigned();
            $table->string('username');
            $table->string('name');
            $table->string('email');
            $table->string('nohp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemenang_arisan');
    }
};
