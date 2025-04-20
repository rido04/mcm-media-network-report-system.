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
        Schema::table('media_placements', function (Blueprint $table) {
            $table->decimal('avg_daily_impression', 10, 2)->default(0)
        ->after('daily_impression_id')
        ->comment('Diisi manual oleh admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_placements', function (Blueprint $table) {
            //
        });
    }
};
