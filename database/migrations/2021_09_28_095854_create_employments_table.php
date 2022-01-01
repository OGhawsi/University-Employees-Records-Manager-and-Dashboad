<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->string('rewards')->nullable();  
            $table->string('rewards_english')->nullable();  
            $table->string('penalties')->nullable();
            $table->string('penalties_english')->nullable();
            $table->string('post_title')->nullable();  //bast 
            $table->string('post_title_english')->nullable();  //bast 
            $table->integer('post_code');  //bast 
            $table->string('designation')->nullable();  
            $table->integer('employment_letter_number'); //ّنمبر حکم تقرر  
            $table->string('academic_rank')->nullable();   
            $table->date('employment_date'); 
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
        Schema::dropIfExists('employments');
    }
}
