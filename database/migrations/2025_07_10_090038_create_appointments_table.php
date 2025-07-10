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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique()->nullable(false);
            $table->foreignId('lead_id')->nullable(false)->constrained('leads')->onDelete('cascade');
            $table->foreignId('sales_agent_id')->nullable(false)->constrained('users')->onDelete('cascade');

            $table->string('title', 255)->nullable(false);
            $table->text('description')->nullable();
            $table->date('appointment_date')->nullable(false);
            $table->time('appointment_time')->nullable(false);
            $table->integer('duration_minutes')->default(60);
            $table->string('location', 255)->nullable();
            $table->enum('meeting_type', ['in_person', 'phone', 'video', 'online'])->default('in_person');

            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->enum('outcome', ['successful', 'no_show', 'reschedule_requested', 'not_interested', 'follow_up_needed'])->nullable();
            $table->text('outcome_notes')->nullable();

            $table->boolean('reminder_sent')->default(false);
            $table->boolean('confirmed_by_client')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index('lead_id', 'idx_lead');
            $table->index('sales_agent_id', 'idx_agent');
            $table->index('appointment_date', 'idx_date');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
