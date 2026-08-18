<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner_sections', function (Blueprint $table) {
            $table->id();

            $table->string('banner_image_1')->nullable();
            $table->string('banner_title_1')->nullable();
            $table->string('banner_subtitle_1')->nullable();
            $table->string('button_text_1')->nullable();
            $table->string('button_url_1')->nullable();

            $table->string('banner_image_2')->nullable();
            $table->string('banner_title_2')->nullable();
            $table->string('banner_subtitle_2')->nullable();
            $table->string('button_text_2')->nullable();
            $table->string('button_url_2')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner_sections');
    }
};
