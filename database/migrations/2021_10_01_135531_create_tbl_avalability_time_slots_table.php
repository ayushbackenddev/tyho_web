<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAvalabilityTimeSlotsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tbl_avalability_time_slots', function (Blueprint $table) {
			$table->id();
			$table->string('avalability_id_fk')->nullable();
			$table->string('time_slot')->nullable();
			$table->string('medium')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('tbl_avalability_time_slots');
	}
}
