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
        Schema::create('categories',  function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('status');
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('assigned_to');
            $table->timestamps();
        });

        Schema::create('category_ticket', function (Blueprint $table) {
            $table->foreignId('category_id');
            $table->foreignId('ticket_id')
                ->constrained('tickets')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_ticket');
    }
};
