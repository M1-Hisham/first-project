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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->enum('type', ['full-time', 'part-time', 'contract', 'Hybrid', 'Remote', 'internship', 'temporary'])->default('full-time');
            $table->decimal('salary', 15, 2)->nullable();
            $table->text('requiredSkills')->nullable();
            $table->unsignedBigInteger('viewCount')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Relationships to categories table
            $table->uuid('categoryId');
            $table->foreign('categoryId')->references('id')->on('job_categories')->onDelete('restrict');
            // Relationships to companies table
            $table->uuid('companyId');
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
