<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('log_id')->index();
            $table->string('client')->nullable()->index();
            $table->string('unit_identifier')->nullable()->index();
            $table->enum('status', ['success', 'fail'])->nullable()->index();
            $table->enum('area', [
                'entranceGate',
                'entranceScale',
                'sorting',
                'washing',
                'incinerator',
                'exitScale',
                'serverError',
            ])->nullable()->index();
            $table->unsignedTinyInteger('feature')->default(0)->index();
            $table->string('event_name')->nullable();
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();
            $table->longText('data')->nullable();

            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
