<?php

use App\Helpers\ConstantHelper;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('location', ConstantHelper::EVENT_LOCATIONS);
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ConstantHelper::COMPANY_NAMES);
            $table->string('bank_account')->nullable();
            $table->decimal('vat_rate', 5, 2)->nullable();
            $table->timestamps();
        });
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ConstantHelper::PAYMENT_METHOD_NAMES);
            $table->enum('type', ConstantHelper::PAYMENT_METHOD_TYPES);
            $table->string('website')->nullable();
            $table->timestamps();
        });
        Schema::create('payment_provider_requests', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method_name')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        Schema::create('event_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->decimal('vat_rate', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_payments');
        Schema::dropIfExists('payment_provider_requests');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('events');
    }
};
