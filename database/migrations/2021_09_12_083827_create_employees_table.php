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

            $table->foreignId('department_id')->nullable();
            $table->foreignId('university_id')->default(1);
            // personal info
            $table->string('first_name');
            $table->string('first_name_english')->nullable();
            $table->string('last_name')->nullable();
            $table->string('last_name_english')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_name_english')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->string('grandfather_name_english')->nullable();
            $table->string('id_tazkira')->unique()->nullable();
            $table->string('passport_number')->unique()->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nationality_english')->nullable();
            $table->tinyInteger('marital_status')->default(1);
            $table->string('native_language')->nullable();
            $table->string('other_languages')->nullable();
            $table->string('profile_photo_url')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->tinyInteger('status')->default(0);

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
