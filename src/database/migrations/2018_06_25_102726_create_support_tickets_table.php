<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->increments('id');
            
            $table->char('title');
            $table->char('type')->nullable();
            $table->string('status')->nullable();
            $table->string('last_reply')->nullable();
            
            $table->boolean('is_flagged');
            $table->boolean('is_ignored');
            
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->timestamp('last_reply_at')->nullable();
            $table->timestamp('read_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
        
        $statement = "ALTER TABLE SUPPORT_TICKETS AUTO_INCREMENT = 390001;";
        DB::unprepared($statement);

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_tickets');
    }
}
