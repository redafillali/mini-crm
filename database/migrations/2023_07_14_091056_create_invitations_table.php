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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'inviter_id' )->nullable()->constrained( 'users' );
            $table->foreignId( 'company_id' )->nullable()->constrained( 'companies' );
            $table->string('invitee_name');
            // invitee_email is unique to prevent duplicate invitations
            $table->string('invitee_email')->unique();
            $table->string('status')->default( 'pending' );
            $table->string('token')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
