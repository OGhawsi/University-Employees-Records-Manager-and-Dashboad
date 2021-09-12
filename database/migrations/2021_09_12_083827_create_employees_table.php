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

            // degree relted information

            $table->string('academic_area');
            $table->string('academic_area_english');
            $table->string('university');
            $table->string('university_english');
            $table->string('degree');
            $table->string('degree_country');
            $table->string('duration_of_study');
            $table->date('start_date');
            $table->date('graduation_date');

            // academic infor

            $table->string('academic_rank');
            $table->string('subject_of_academic_research');
            $table->string('type_of_academic_research');
            $table->date('registration_of_academic_research');
            $table->date('completion_of_academic_research');
            $table->date('submission_of_academic_research');
            $table->date('year_of_academic_research');  //unnecessary ??? TODO:

            $table->string('rewards')->nullable();  
            $table->string('pernalties')->nullable();

            $table->string('post');  //bast 
            $table->string('post_title');  //bast 
            $table->string('post_title_english');  //bast 
            $table->string('post_code');  //bast 
            $table->string('designation');  
            $table->string('teaching_univeristy');  
            $table->string('teaching_faculty');  
            $table->string('teaching_department');  
            $table->string('hiring_number'); //ّنمبر حکم تقرر  
            $table->string('hiring_accademic_rank');   
            $table->date('hiring_date');   
            $table->date('reacing_to_accademic_rank_date');   

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
