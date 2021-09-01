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
            $table->string("nrodoc")->default('');
            $table->string("mes")->default('');
            $table->string("gestion")->default('');
            $table->date("fechaaprobacion")->nullable();
            $table->dateTime("fechapago")->nullable();
            $table->string("monto")->default('');
            $table->string("estado")->default('PENDIENTE');
            $table->string("foto")->default('');
            $table->unsignedBigInteger("beneficiario_id");
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios');
            $table->unsignedBigInteger("user_id");
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
