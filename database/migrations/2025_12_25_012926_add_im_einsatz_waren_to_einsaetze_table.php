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
        Schema::table('einsaetze', function (Blueprint $table) {
            $table->json('im_einsatz_waren')->nullable()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('einsaetze', function (Blueprint $table) {
            $table->dropColumn('im_einsatz_waren');
        });
    }
};
