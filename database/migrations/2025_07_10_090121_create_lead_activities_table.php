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
        Schema::create('lead_activities', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique()->nullable(false);
            $table->foreignId('lead_id')->nullable(false)->constrained('leads')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('activity_type', 100)->nullable(false);
            $table->string('title', 255)->nullable(false);
            $table->text('description')->nullable();
            $table->string('outcome', 100)->nullable();
            $table->timestamp('activity_date')->nullable(false);
            $table->integer('duration_minutes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->index('lead_id', 'idx_lead');
            $table->index('user_id', 'idx_user');
            $table->index('activity_type', 'idx_type');
            $table->index('activity_date', 'idx_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_activities');
    }
};
