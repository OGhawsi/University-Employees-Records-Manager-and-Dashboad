<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // personal info
            $table->string('first_name');
            $table->string('first_name_english')->nullable();
            $table->string('last_name');
            $table->string('last_name_english')->nullable();
            $table->string('father_name');
            $table->string('father_name_english')->nullable();
            $table->string('grandfather_name');
            $table->string('grandfather_name_english')->nullable();
            $table->string('id_tazkira');
            $table->enum('gender',['male','female']);
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('nationality_english');
            $table->string('marital_status');
            $table->string('native_language');

            // address and contact info
            $table->numeric('contact_no');
            $table->string('email');
            $table->string('province');
            $table->string('province_english');
            $table->string('current_address');
            $table->string('current_address_english');
            $table->string('permanent_address');
            $table->string('permanent_address_english');

            // academic information







            $table->string('academic_rank')->nullable();
            $table->string('city')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
