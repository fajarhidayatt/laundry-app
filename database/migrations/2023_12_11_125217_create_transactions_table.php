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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id')->nullable();
            $table->string('invoice', 100)->nullable()->unique();
            $table->integer('member_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->dateTime('time_limit')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('additional_cost')->nullable();
            $table->double('discount')->nullable();
            $table->integer('tax')->nullable();
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil'])->nullable();
            $table->enum('payment_status', ['lunas', 'belum'])->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
