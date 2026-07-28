<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('smoking')->nullable()->after('complaint');
            $table->boolean('alcohol')->nullable()->after('smoking');
        });

        // Mevcut kayıtlar için varsayılan "Hayır" (false)
        DB::table('patients')->update([
            'smoking' => false,
            'alcohol' => false,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['smoking', 'alcohol']);
        });
    }
};
