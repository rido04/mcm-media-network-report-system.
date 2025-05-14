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
        Schema::create('media_placements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_traffic_id')->constrained('admin_traffic')->onDelete('cascade');
            $table->string('media')->max(10);
            $table->string('space_ads');
            $table->string('size');
            $table->foreignId('daily_impression_id')->nullable()->contrained()->onDelete('cascade');
            $table->foreignId('media_statistic_id')->nullable()->contrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_placements');
    }
};
