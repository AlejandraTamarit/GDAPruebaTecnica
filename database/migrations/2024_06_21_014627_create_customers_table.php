<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', ['A', 'I', 'trash'])->default('A');
            $table->foreignId('region_id')->constrained()->references('id_reg')->on('regions')->onDelete('cascade');
            $table->foreignId('commune_id')->constrained()->references('id_com')->on('communes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
