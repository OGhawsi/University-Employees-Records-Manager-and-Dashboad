<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDegreesTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->string('study_field')->nullable();
            $table->string('study_field_english')->nullable();
            $table->string('faculty')->nullable();
            $table->string('faculty_english')->nullable();
            $table->string('university')->nullable();
            $table->string('university_english')->nullable();
            $table->tinyInteger('degree_name')->default(1);
            $table->string('country')->nullable();
            $table->string('country_english')->nullable();
            $table->date('start_date')->nullable();
            $table->date('graduation_date')->nullable();
            $table->boolean('current')->default(false);
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('degrees');
    }
}
