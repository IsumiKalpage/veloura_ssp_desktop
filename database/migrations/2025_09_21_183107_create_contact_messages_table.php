<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('contact_messages', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('message');
            $table->string('ip_address')->nullable();
            $table->string('status')->default('new'); 
            $table->timestamps();
        });
    }
    
  
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
