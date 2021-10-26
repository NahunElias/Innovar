<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssigmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('classId');
            $table->unsignedBigInteger('sectionId');
            $table->unsignedBigInteger('subjectId');
            $table->unsignedBigInteger('teacherId');

            $table->string('AssignTitle');
            $table->text('AssignDescription')->nullable();
            $table->string('AssignFile');
            $table->string('AssignDeadLine');            

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
        Schema::dropIfExists('assigments');
    }
}
