<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Database migration for the members table.
 */
class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_identifier')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('international_dialling_code')->nullable();
            $table->string('domestic_phone_number')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('members');
    }
}
