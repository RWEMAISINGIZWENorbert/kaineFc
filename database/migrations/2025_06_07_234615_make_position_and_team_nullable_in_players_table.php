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
        Schema::table('players', function (Blueprint $table) {
            // Drop the existing foreign key constraints
            $table->dropForeign(['position_id']);
            $table->dropForeign(['team_id']);
            
            // Drop the columns
            $table->dropColumn(['position_id', 'team_id']);
            
            // Recreate the columns as nullable
            $table->foreignId('position_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            // Drop the nullable foreign key constraints
            $table->dropForeign(['position_id']);
            $table->dropForeign(['team_id']);
            
            // Drop the columns
            $table->dropColumn(['position_id', 'team_id']);
            
            // Recreate the columns as non-nullable
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
        });
    }
};
