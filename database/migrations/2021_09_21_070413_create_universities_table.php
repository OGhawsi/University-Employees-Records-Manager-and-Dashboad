<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use illuminate\Support\Carbon;

class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->integer('seats')->nullable();
            $table->foreignId('employee_id')->unique()->nullable();
            $table->date('established');
            $table->softDeletes();
            $table->timestamps();
        });     


        \App\Models\University::create([
            'name' => 'XYZ University',
            'seats' => '589',
            'email' => 'xyz@example.com',
            'established' => '2021-09-21',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
}
