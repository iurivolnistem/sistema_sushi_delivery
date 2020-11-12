<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['id_cliente', 'valor', 'status'];

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'produto_pedido', 'id_pedido', 'id_produto')->withPivot('quantidade');
    }

    public function cliente(){
        return $this->hasOne(Cliente::class, 'id', 'id_cliente');
    }
}
