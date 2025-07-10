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
        Schema::create('revenue_tracking', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique()->nullable(false);
            $table->foreignId('lead_id')->nullable(false)->constrained('leads')->onDelete('cascade');
            $table->foreignId('referral_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('sales_agent_id')->nullable()->constrained('users')->onDelete('set null');

            $table->decimal('deal_value', 10, 2)->nullable(false);
            $table->decimal('commission_rate', 5, 2)->nullable(false);
            $table->decimal('commission_amount', 10, 2)->nullable(false);

            $table->enum('status', ['pending', 'approved', 'paid', 'disputed'])->default('pending');
            $table->date('payment_date')->nullable();

            $table->timestamps();

            $table->index('lead_id', 'idx_lead');
            $table->index('referral_id', 'idx_referral');
            $table->index('sales_agent_id', 'idx_agent');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_tracking');
    }
};
