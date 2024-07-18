<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tbl_order', function (Blueprint $table) {
			$table->id();
			$table->string('therapist_id_fk')->nullable();
			$table->string('client_id_fk')->nullable();
			$table->string('date_of_booking')->nullable();
			$table->string('service_id_fk')->nullable();
			$table->string('medium_id_fk')->nullable();
			$table->string('charge')->nullable();
			$table->string('discount_coupon')->nullable();
			$table->string('transaction_id')->nullable();
			$table->string('amount')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('tbl_order');
	}
}
