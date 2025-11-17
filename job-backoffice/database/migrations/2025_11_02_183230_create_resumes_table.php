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
        Schema::create('resumes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fileName');
            $table->string('fileURL');
            $table->string('contactDetails');
            $table->longText(column: 'skills');
            $table->longText(column: 'summary');
            $table->longText('experience');
            $table->longText('education');

            $table->timestamps();
            $table->softDeletes();
            // Relationship to users table
            $table->uuid('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
