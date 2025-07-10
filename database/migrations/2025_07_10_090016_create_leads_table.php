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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique()->nullable(false);
            $table->string('lead_number', 50)->unique()->nullable(false);

            // Client Information
            $table->string('client_first_name', 100)->nullable(false);
            $table->string('client_last_name', 100)->nullable(false);
            $table->string('client_email', 255)->nullable();
            $table->string('client_phone', 20)->nullable();
            $table->text('client_address')->nullable();
            $table->string('client_city', 100)->nullable();
            $table->string('client_country', 100)->nullable();

            // Lead Details
            $table->string('product_interest', 255)->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->string('timeline', 100)->nullable();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->string('source', 100)->nullable();
            $table->text('notes')->nullable();

            // Lead Management
            $table->enum('status', ['new', 'assigned', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost', 'cancelled'])->default('new');
            $table->string('substatus', 100)->nullable();

            // Relationships
            $table->foreignId('referral_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('organization_id')->nullable(false)->constrained('organizations')->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained('teams')->onDelete('set null');

            // Tracking
            $table->string('wordpress_form_id', 100)->nullable();
            $table->string('baserow_id', 100)->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('first_contact_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();

            // Revenue
            $table->decimal('estimated_value', 10, 2)->nullable();
            $table->decimal('actual_value', 10, 2)->nullable();
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->decimal('commission_amount', 10, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('lead_number', 'idx_lead_number');
            $table->index('status', 'idx_status');
            $table->index('referral_id', 'idx_referral');
            $table->index('assigned_to', 'idx_assigned');
            $table->index('organization_id', 'idx_organization');
            $table->index('team_id', 'idx_team');
            $table->index('created_at', 'idx_created_at');
            $table->index('priority', 'idx_priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
