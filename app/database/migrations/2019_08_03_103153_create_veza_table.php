<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatevezaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('veza', function(Blueprint $table) {
			$table -> increments('id');
			$table -> integer('radnik')->unsigned()->index();
			$table->foreign('radnik')->references('id')->on('radnici')->onDelete('cascade')->onUpdate('cascade');
			$table -> integer('proizvod')->unsigned()->index();
			$table->foreign('proizvod')->references('id')->on('proizvodi')->onDelete('cascade')->onUpdate('cascade');
			$table -> decimal('kolicina', 8,3);
			$table -> integer('magacin');
			$table -> nullableTimestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('veza');
	}

}
