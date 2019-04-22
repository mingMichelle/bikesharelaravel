<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRidersTable.
 */
class CreateRidersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riders', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->unsignedInteger('bike_id')->index()->comment('单车ID');
            $table->dateTime('start_at')->comment('开始骑行时间');
            $table->dateTime('end_at')->nullable()->comment('上锁时间');
            $table->unsignedInteger('money')->nullable()->comment('金额');
            $table->boolean('is_pay')->default(false)->comment('是否已经支付');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bike_id')->references('id')->on('bikes')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('riders');
	}
}
