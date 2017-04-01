<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('repos', function (Blueprint $table) {
             $table->increments('id');
             $table->string('url');
             $table->string('bitbucket')->unique();
             $table->string('directory');
             $table->string('remote');
             $table->string('branch');
             $table->boolean('auto_deploy');
             $table->text('comments')->nullable();
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
         Schema::dropIfExists('repos');
     }
}
