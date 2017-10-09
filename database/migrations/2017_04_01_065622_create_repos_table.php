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
             $table->string('url')->nullable();
             $table->string('bitbucket')->unique();
             $table->string('directory')->nullable();
             $table->string('remote')->nullable();
             $table->string('branch')->nullable();
             $table->boolean('auto_deploy')->default(false);
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
