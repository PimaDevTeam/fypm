<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_projects', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id'); // student's ID
            $table->integer('project_id')->nullable(); // id from projects table
            $table->integer('supervisor_id'); // Supervisor's ID
            $table->integer('session_id'); // session id from session table
            // $table->integer('supervisor_score');
            // $table->integer('first_sem_score');
            // $table->integer('second_sem_score');
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
        Schema::dropIfExists('user_projects');
    }
}
