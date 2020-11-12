<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;

class PedidoController extends Controller
{
    public function somarPedidos(){
        $ano = date('Y');
        $from = $ano.'-'.'01-01'; 
        $to = $ano.'-'.'12-31';
        $soma = Pedido::where('status', 'Entregue')->whereBetween('created_at', [$from, $to])->sum('valor');
        

        return response()->json($soma);
    }

    public function somarPedidosMes(){
        $mes = date('m');
        $ano = date('Y');

        $from = $ano.'-'.$mes.'-01';
        $dias_mes = date('t', strtotime($from));
        $to = $ano.'-'.$mes.'-'.$dias_mes;

        $soma = Pedido::where('status', 'Entregue')->whereBetween('created_at', [$from, $to])->sum('valor');

        return response($soma);
    }

    public function buscarPedidos(){
        $aguardando = Pedido::where('status', 'Aguardando')->orderBy('created_at', 'ASC')->get();
        $preparando = Pedido::where('status', 'Preparo')->orderBy('created_at', 'DESC')->get();
        $saiu       = Pedido::where('status', 'Saiu')->orderBy('created_at', 'DESC')->get();
        $entregue   = Pedido::where('status', 'Entregue')->orderBy('created_at', 'DESC')->get();

        return View('dashboard.lista_pedidos', compact('aguardando','preparando','saiu','entregue', $aguardando, $preparando, $saiu, $entregue));
    }

    public function getPedidosStatus(){
        $aguardando = Pedido::where('status', 'Aguardando')->count();
        $saiu = Pedido::where('status', 'Saiu')->count();
        $preparando = Pedido::where('status', 'Preparo')->count();
        $entregue = Pedido::where('status', 'Entregue')->count();

        $array = [$aguardando, $saiu, $preparando, $entregue];

        return response($array);
    }

    public function getEntradasMes(){

        $ano = date('Y');
        $array = [];
        for($i = 1; $i <= 12; $i++){
            $from = $ano.'-'.$i.'-01';
            $dias_mes = date('t', strtotime($from));
            $to = $ano.'-'.$i.'-'.$dias_mes;

            $query = Pedido::where('status', 'Entregue')->whereBetween('created_at', [$from, $to])->sum('valor');
            array_push($array, $query);

        }
        return response($array);
    }

    public function buscarPedido($id){
        $pedido = Pedido::find($id);
        
        if($pedido != null){
            $pedido_produtos = $pedido->produtos;
            $pedido_cliente = $pedido->cliente;

            return response()->json(['pedido' => $pedido, 'endereco' => $pedido->cliente->enderecos]);
        }
    }
}
