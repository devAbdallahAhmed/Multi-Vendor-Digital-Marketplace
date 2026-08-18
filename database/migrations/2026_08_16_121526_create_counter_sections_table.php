<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('counter_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->string('label_1');
            $table->integer('counter_1');
            $table->string('label_2');
            $table->integer('counter_2');
            $table->string('label_3');
            $table->integer('counter_3');
            $table->string('label_4');
            $table->integer('counter_4');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('counter_sections');
    }
};
