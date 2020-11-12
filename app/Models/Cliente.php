<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    
    protected $fillable = ['nome', 'cpf', 'email', 'senha', 'status'];

    public function enderecos(){
        return $this->hasMany(Endereco::class, 'id_cliente', 'id')->where('status', true);
    }
}
