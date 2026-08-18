<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_sections', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('item_sold')->nullable();
            $table->string('community_earnings')->nullable();
            $table->string('copyright');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_sections');
    }
};
