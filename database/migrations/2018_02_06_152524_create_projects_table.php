<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('thai_name')->nullable();
            $table->string('eng_name')->nullable();
            $table->integer('typeProjectId')->unsigned();
<<<<<<< HEAD
            $table->integer('advisorsId');
            $table->integer('developerId');
            $table->string('abstack');
            $table->string('keywords');
=======
            $table->integer('advisorsId')->nullable();
            $table->integer('developerId')->nullable();
            $table->integer('abstack');
            $table->integer('keywords');
>>>>>>> dev-Army
            $table->integer('userId')->unsigned();
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
        Schema::dropIfExists('projects');
        //$table->dropForeign('projects_typeProjectId_foreign');
    }
}
