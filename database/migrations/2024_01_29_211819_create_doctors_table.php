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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('phone');
            $table->string('image')->default('doctors/default.jpg');
            $table->integer('rate')->nullable();
            $table->boolean('recommandation')->default(0); // 0 => no,1 => yes
            $table->bigInteger('nid');
            $table->longText('bio');
            $table->string('img_verify');
            $table->integer('status')->default(0) ; // 0 => new , 1 => verify , 2 => block
            $table->foreignId('gov_id')->references('id')->on('governments')->onDelete('cascade');
            $table->foreignId('special_id')->references('id')->on('specializations')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
