<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('logs', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('repo_id');
      $table->foreign('repo_id')
      ->references('id')
      ->on('repos')
      ->onDelete('cascade')
      ->onUpdate('cascade');
      $table->text('content');
      $table->string('madeBy');
      $table->unsignedInteger('user_id');
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
    Schema::drop('logs');
  }
}
