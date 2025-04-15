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
        Schema::create('ad_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_traffic_id')->constrained('admin_traffic')->onDelete('cascade');
            $table->integer('used_placement');
            $table->integer('available_placement')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_performances');
    }
};
