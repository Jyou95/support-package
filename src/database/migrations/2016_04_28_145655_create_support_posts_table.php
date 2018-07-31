<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_posts', function (Blueprint $table) {
            $table->increments('id');
            
            $table->text('message')->nullable();
            
            $table->boolean('is_markdown');
            $table->boolean('is_draft');
            
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('support_ticket_id')->unsigned()->index();
            $table->foreign('support_ticket_id')->references('id')->on('support_tickets');
            
            $table->timestamp('published_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('support_posts');
    }
}
