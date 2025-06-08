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
        Schema::table('staff', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['department_id']);
            
            // Modify the column to be nullable
            $table->foreignId('department_id')->nullable()->change();
            
            // Re-add the foreign key constraint
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            // Drop the nullable foreign key constraint
            $table->dropForeign(['department_id']);
            
            // Modify the column to be non-nullable
            $table->foreignId('department_id')->nullable(false)->change();
            
            // Re-add the foreign key constraint
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }
};
