<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_produto')->unsigned()->nullable();
            $table->foreign('id_produto')->references('id')->on('produtos');

            $table->integer('id_pedido')->unsigned()->nullable();
            $table->foreign('id_pedido')->references('id')->on('pedidos');
            $table->integer('quantidade');
            $table->timestampsTz(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_pedido');
    }
}
