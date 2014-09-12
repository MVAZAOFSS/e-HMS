<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guests', function(Blueprint $table) {
			$table->increments('id');
			$table->string('lastname');
			$table->string('firstname');
			$table->string('nationality');
			$table->string('address');
			$table->string('passport_number');
			$table->string('country');
			$table->string('id_number');
			$table->string('professional');
			$table->string('company');
			$table->string('telephone');
			$table->string('fax');
			$table->string('job');
			$table->string('mobile');
			$table->string('email');
			$table->string('room_number');
			$table->string('rate');
			$table->integer('adults');
			$table->integer('children');
			$table->date('arrival_date');
			$table->date('departure_date');
			$table->string('reservation_number');
			$table->string('mode');
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
		Schema::drop('guests');
	}

}
