<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('image_url', 255)->nullable();
            $table->string('description', 100);
            $table->string('app_url', 255);
            $table->string('theme_color')->default('bg-gray-50 border-gray-200');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
