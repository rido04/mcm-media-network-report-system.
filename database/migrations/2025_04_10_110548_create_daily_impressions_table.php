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
        Schema::create('daily_impressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_traffic_id')->constrained('admin_traffic')->onDelete('cascade'); // Pastikan nama tabel sesuai
            $table->foreignId('media_statistic_id')->constrained('media_statistics')->onDelete('cascade'); // Pastikan nama tabel sesuai
            $table->date('date');
            $table->integer('impression');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_impressions');
    }
};
