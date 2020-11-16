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
            $table->integer('user_id'); // id from users table
            $table->integer('project_id'); // id from projects table
            $table->integer('project_role_id'); // id from project_roles table
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
