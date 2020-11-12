<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $fillable = ['nome', 'cep','logradouro', 'bairro', 'cidade', 'estado', 'numero', 'complemento', 'status', 'id_cliente'];
}
