<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function dashboardClientes(){
        $lista = Cliente::where('status', true)->count();

        if($lista > 0){
            return response()->json(['status' => 'true', 'clientes' => $lista]);
        }
        else{
            return response()->json(['status' => 'false', 'mensagem' => 'Nenhum cliente cadastrado!']);
        }
    }
}
