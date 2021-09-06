<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string("tipodoc");
            $table->string("nro");
            $table->string("exp");
            $table->string("razon");
            $table->string("banco")->default('');
            $table->string("cuenta")->default('');
            $table->string("nrodocpago");
            $table->string("mes")->default('');
            $table->string("gestion")->default('');
            $table->date("fechaaprobacion")->nullable();
            $table->dateTime("fechapago")->nullable();
            $table->double("monto")->default(0);
            $table->string("estado")->default('PENDIENTE');
            $table->string("foto")->default('');
            $table->unsignedBigInteger("user_id")->nullable()->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger("responsable_id")->nullable();
            $table->foreign('responsable_id')->references('id')->on('responsables');
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
        Schema::dropIfExists('pagos');
    }
}
