<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->string('name_en', 255);
			$table->string('name_ar', 255);
			$table->string('notes');
		});
	}

	public function down()
	{
		Schema::drop('grades');
	}
}