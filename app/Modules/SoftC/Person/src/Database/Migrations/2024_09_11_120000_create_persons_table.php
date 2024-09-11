<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id')->comment('Rekord azonosító');
            $table->string('name')->comment('Név');
            $table->string('email')->unique()->comment('Email');
            $table->string('phone')->comment('Telefon');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};