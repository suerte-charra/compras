<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adquisicions', function (Blueprint $table) {
            $table->id('idadquisicion');
            $table->date('fechaadqui');
            $table->string('folio');
            $table->string('documento');
            $table->string('investigacion');
            $table->string('resrequi');
            $table->string('partida');
            $table->text('descripcion');
            $table->text('descripcionadqui');
            $table->double('monto');
            $table->string('proveedor');
            $table->date('fechaaprox');
            $table->date('fechaentrega');
            $table->text('observaciones');
            $table->integer('adquisicion_estatus')->default(1)->comment('0 deshabilitado, 1 activo');
            $table->unsignedBigInteger('cat_dep');
            $table->foreign('cat_dep')->references('iddependencia')->on('dependencias');
            $table->unsignedBigInteger('cat_clas');
            $table->foreign('cat_clas')->references('idclasificacion')->on('clasificacions');
            $table->unsignedBigInteger('cat_med');
            $table->foreign('cat_med')->references('idmedida')->on('medidas');
            $table->unsignedBigInteger('cat_fin');
            $table->foreign('cat_fin')->references('idfinanciamiento')->on('financiamientos');
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
        Schema::dropIfExists('adquisicions');
    }
};
