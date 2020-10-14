<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_forums', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id'); // references id on projects's table
            $table->integer('post_by'); // references id on user's table
            $table->string('forum_title');
            $table->longText('forum_details');
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('project_forums');
    }
}
