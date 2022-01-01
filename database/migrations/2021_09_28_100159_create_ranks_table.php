<?php

use App\Models\Rank;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanksTable extends Migration
{

    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_english');
            $table->tinyInteger('academic_rank');
        });


        Schema::create('employee_rank', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('rank_id');
            $table->string('subject_of_academic_research')->nullable();
            $table->date('registration_of_academic_research')->nullable();
            $table->date('completion_of_academic_research')->nullable();
            $table->boolean('current')->default(false);
            $table->unique(['employee_id', 'rank_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ranks');
        Schema::dropIfExists('employee_rank');
    }
}
