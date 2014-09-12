<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendituresTable extends Migration {

	public function up()
	{
         Schema::create('expenditures',function($table){
             $table->increments('exp_id');
             $table->string('cost',255);
             $table->string('expenditure_name',50);
             $table->string('expenditure_reasons',255);
             $table->string('date',50);
             $table->string('consumed_by',255);
             $table->timestamps();
         });
	}

	public function down(){
	Schema::drop('expenditures');	
	}

}
