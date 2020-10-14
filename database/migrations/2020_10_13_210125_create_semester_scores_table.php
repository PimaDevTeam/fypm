<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('user_project_id'); // id from users table to identify the student
            $table->integer('grade_by'); // id from users table
            $table->integer('first_sem_score');
            $table->integer('second_sem_score');
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
        Schema::dropIfExists('semester_scores');
    }
}
