<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expendictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pv_no')->nullable();
            $table->date('payment_date');
            $table->string('payee_name');
            $table->string('code')->nullable();
            $table->decimal('amount', 10,2);
            $table->decimal('tax', 10,2)->nullable();
            $table->decimal('net', 10,2);
            $table->string('cheque_no')->unique();
            $table->string('tax_status')->nullable();
            $table->unsignedInteger('expendicture_type_id');
            $table->foreign('expendicture_type_id')
                  ->references('id')->on('expendicture_types')
                  ->onDelete('CASCADE');
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
        Schema::dropIfExists('expendictures');
    }
}
