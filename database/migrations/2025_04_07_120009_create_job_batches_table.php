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
        Schema::create('job_batches', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('job_name');
            $table->string('business_id')->nullable();
            $table->integer('chunk_size')->nullable();
            $table->integer('total_chunks');
            $table->integer('completed_chunks')->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      //  Schema::dropIfExists('job_batches');
    }
};
