<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['pending', 'reviewed', 'interviewed', 'hired', 'rejected', 'accepted'])->default('pending');
            $table->float('aiGeneratedScore', 2)->default(0);
            $table->text('aiGeneratedFeedback')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Relationships to job_vacancies table
            $table->uuid('jobId');
            $table->foreign('jobId')->references('id')->on('job_vacancies')->onDelete('restrict');
            // Relationships to resumes table
            $table->uuid('resumeId');
            $table->foreign('resumeId')->references('id')->on('resumes')->onDelete('restrict');
            // Relationships to users table
            $table->uuid('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
