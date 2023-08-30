<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobileno')->nullable();
            $table->string('email')->unique();
            $table->string('usertype')->default('normal');
            $table->string('designation')->nullable();
            $table->string('category')->nullable();
            $table->string('districtcd')->nullable();
            $table->string('subdivisioncd')->nullable();
            $table->string('parliamentcd')->nullable();
            $table->string('assemblycd')->nullable();
            $table->string('blockmunicd')->nullable();
            $table->string('zonecd')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
