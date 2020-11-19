<?php

namespace App\Http\Controllers\Web;

use App\Exports\ClientesExport;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function lista(){
        $lista_clientes = Cliente::all();

        return View('dashboard.lista_clientes', compact('lista_clientes', $lista_clientes));
    }

    public function excluir($id){
        $row = Cliente::where('id', '=', $id)->count();

        if($row > 0){
            Cliente::where('id', '=', $id)->update([
                'status' => 0
            ]);

            return redirect()->back()->with('mensagem', 'Cliente excluido com sucesso!');
        }
        else{
            return redirect()->back()->with('mensagem', 'Este Cliente não existe!');
        }
    }

    public function ativarCliente($id){
        $row = Cliente::where('id', '=', $id)->count();

        if($row > 0){
            Cliente::where('id', '=', $id)->update([
                'status' => 1
            ]);

            return redirect()->back()->with('mensagem', 'Cliente ativado com sucesso!');
        }
        else{
            return redirect()->back()->with('mensagem', 'Este Cliente não existe!');
        }
    }

    public function exportar(){
        return Excel::download(new ClientesExport, 'clientes.xls');
    }
}
