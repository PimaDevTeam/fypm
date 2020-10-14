<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_requirements', function (Blueprint $table) {
            $table->id();
            $table->integer('supervisor_score');  // student's main supervisor
            $table->integer('first_sem_panel_requirement');
            $table->integer('second_sem_panel_requirement');
            $table->integer('program_id');
            $table->integer('session_id');
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
        Schema::dropIfExists('grade_requirements');
    }
}
