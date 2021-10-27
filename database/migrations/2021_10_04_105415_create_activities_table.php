<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('state');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('teacher_id');

            $table->foreign('student_id')->references('id')->on('students');        
            $table->foreign('qualification_id')->references('id')->on('qualifications');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            

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
        Schema::dropIfExists('activities');
    }
}
