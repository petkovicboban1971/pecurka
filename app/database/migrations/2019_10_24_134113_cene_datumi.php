<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeneDatumi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){

		Schema::create('cene_datumi', function(Blueprint $table){
			$table->increments('id');
			$table->decimal('cene', 10, 2);
			$table->integer('proizvod_id')->unsigned();
			$table->timestamps('Y-m-d');

			$table->foreign('proizvod_id')->references('id')->on('proizvodi');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		  Schema::drop('cene_datumi');
	}

}
