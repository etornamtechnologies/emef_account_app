<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('payee_name');
            $table->integer('registration_no');
            $table->unsignedInteger('revenue_type_id');
            $table->foreign('revenue_type_id')
                  ->references('id')->on('revenue_types')
                  ->onDelete('CASCADE');
            $table->decimal('amount', 10,2); 
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
        Schema::dropIfExists('revenues');
    }
}
