<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectForumCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_forum_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('project_forum_id'); // references id from project forum table
            $table->longText('comment');
            $table->integer('comment_by'); // references id from user's table
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
        Schema::dropIfExists('project_forum_comments');
    }
}
