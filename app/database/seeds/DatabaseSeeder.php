<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		//$this->call('PostsTableSeeder');
		$this->call('UsersTableSeeder');
		//$this->call('RoomsTableSeeder');
		//$this->call('RestaurantsTableSeeder');
		//$this->call('LaundriesTableSeeder');
		//$this->call('BarsTableSeeder');
		$this->call('GuestsTableSeeder');
		$this->call('NotificationsTableSeeder');
		$this->call('BillsTableSeeder');
	}

}