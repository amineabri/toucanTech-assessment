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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger("UserRefID");
            $table->integer("emailID");
            $table->string("emailAddress");
            $table->boolean("Default")->default(false);
            $table->timestamps();
            // Add foreign key to profiles table
            $table->foreign('UserRefID')->references('UserRefID')->on('profiles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emails', function (Blueprint $table) {
            // Drop the unique index on ('UserRefID', 'emailID') columns
            $table->dropUnique(['UserRefID', 'emailID']);

            $table->dropForeign(['UserRefID']);
        });

        Schema::dropIfExists('emails');
    }
};
