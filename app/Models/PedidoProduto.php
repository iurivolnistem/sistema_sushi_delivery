<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $table = 'produto_pedido';
    protected $fillable = ['id_produto','id_pedido', 'quantidade'];
}
