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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('code', 2)->unique();
            $table->timestamps();
            $table->index('name');
        });

        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('school_name');
            $table->timestamps();
            $table->unsignedBigInteger('country_id')->nullable();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->index('school_name');
        });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('school_id');
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('schools');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('schools');
        Schema::dropIfExists('countries');
    }
};
