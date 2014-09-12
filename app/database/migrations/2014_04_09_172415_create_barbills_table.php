<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarbillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barbills', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('guestid');
			$table->text('foods');
			$table->string('paymentmode');
			$table->double('amount');
			$table->string('added_by');
			$table->double('remain');
			$table->double('overpay');
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
		Schema::drop('barbills');
	}

}
