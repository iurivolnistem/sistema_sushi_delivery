<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use App\Models\Telefone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function __construct(){
        $this->aguardando = 0;
        $this->preparo = 1;
        $this->saiu = 2;
        $this->entregue = 3;
        $this->cancelado = 4;
        $this->devolvido = 5;
    }

    //Funções de endereço

    public function cadastrarEndereco(Request $request){
        $validacao = Validator::make($request->all(),[
            'nome' => 'required|regex:/^[a-zA-Z ]*$/|max:20',
            'cep' => 'required|max:9',
            'logradouro' => 'required|max:100|regex:/^[a-zA-Z ]*$/|string',
            'bairro' => 'max:100|string|regex:/^[a-zA-Z ]*$/',
            'cidade' => 'required|max:100|regex:/^[a-zA-Z ]*$/|string',
            'estado'    => 'required|max:2',
            'numero' => 'required|max:10',
            'complemento' => 'max:100|'
        ]);

        if($validacao->fails()){
            return response()->json(['error' => 'validação', 'erros' => $validacao->errors()]);
        }
        else{
            $endereco = Endereco::create([
                'nome' => $request->nome,
                'cep' => $request->cep,
                'logradouro' => $request->logradouro,
                'bairro' => $request->bairro == '' ? 'Centro' : $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'id_cliente' => $request->id_cliente,
                'status' => 0
            ]);

            $this->changeEnderecoAtivo($endereco->id, $endereco->id_cliente);

            return response()->json(['error' => '', 'mensagem' => 'Endereço cadastrado com sucesso!']);
        }
    }

    public function getEnderecos($id){
        $enderecos = Endereco::where('id_cliente', $id)->orderBy('status', 'DESC')->get();

        if($enderecos != ''){
            return response()->json(['error' => '', 'enderecos' => $enderecos]);
        }
        else{
            return response()->json(['error' => 'Nenhum endereço encontrado']);
        }
    }

    public function changeEnderecoAtivo($id, $id_cliente){
        $cliente_enderecos = Endereco::where('id_cliente', $id_cliente)->get();

        foreach($cliente_enderecos as $key => $endereco){
            if($endereco->id == $id && $endereco->status == true){
                return response()->json(['error' => 'O endereço que está tentando ativar já é ativo.']);
            }
            elseif($endereco->id == $id && $endereco->status == false){
                $ativo = Endereco::where('id_cliente', $id_cliente)->where('status', true)->first();

                if($ativo != null){
                    $ativo->update([
                        'status' => 0
                    ]);
                }

                $endereco->update([
                    'status' => 1
                ]);

                return response()->json(['error' => '', 'mensagem' => 'Endereço ativo!']);
            }
        }
    }

    public function excluirEndereco($id, $id_cliente){

        $cliente_enderecos = Endereco::where('id_cliente', $id_cliente)->get();

        foreach($cliente_enderecos as $key => $endereco){
            if($endereco->id == $id){
                $endereco->delete();

                return response()->json(['error' => '', 'mensagem' => 'Endereço excluido com sucesso!']);
            }
        }
    }

    //fim

    //Funções de telefones

    public function cadastrarTelefone(Request $request){
        $validacao = Validator::make($request->all(),[
            'nome' => 'required|regex:/^[a-zA-Z ]*$/|max:20',
            'numero' => 'required|max:14',
        ]);

        if($validacao->fails()){
            return response()->json(['error' => 'validação', 'erros' => $validacao->errors()]);
        }
        else{
            $telefone = Telefone::create([
                'nome' => $request->nome,
                'numero' => $request->numero,
                'id_cliente' => $request->id_cliente,
                'status' => 0
            ]);

            $this->changeTelefoneAtivo($telefone->id, $telefone->id_cliente);

            return response()->json(['error' => '', 'mensagem' => 'Telefone cadastrado com sucesso!']);
        }
    }

    public function getTelefones($id){
        $telefones = Telefone::where('id_cliente', $id)->orderBy('status', 'DESC')->get();

        if($telefones != ''){
            return response()->json(['error' => '', 'telefones' => $telefones]);
        }
        else{
            return response()->json(['error' => 'Nenhum telefone encontrado']);
        }
    }

    public function changeTelefoneAtivo($id, $id_cliente){
        $cliente_telefones = Telefone::where('id_cliente', $id_cliente)->get();

        foreach($cliente_telefones as $key => $telefone){
            if($telefone->id == $id && $telefone->status == true){
                return response()->json(['error' => 'O telefone que está tentando ativar já é ativo.']);
            }
            elseif($telefone->id == $id && $telefone->status == false){
                $ativo = Telefone::where('id_cliente', $id_cliente)->where('status', true)->first();

                if($ativo != null){
                    $ativo->update([
                        'status' => 0
                    ]);
                }

                $telefone->update([
                    'status' => 1
                ]);

                return response()->json(['error' => '', 'mensagem' => 'Telefone ativo!']);
            }
        }
    }

    public function excluirTelefone($id, $id_cliente){

        $cliente_telefones = Telefone::where('id_cliente', $id_cliente)->get();

        foreach($cliente_telefones as $key => $telefone){
            if($telefone->id == $id){
                $telefone->delete();

                return response()->json(['error' => '', 'mensagem' => 'Telefone excluido com sucesso!']);
            }
        }
    }

    //fim

    //Funções de produtos

    public function getProdutos(){
        $lista = Produto::where('status', true)->get();

        if($lista != ''){
            return response()->json(['error' => '', 'data' => $lista]);
        }
        else{
            return response()->json(['error' => 'Nenhum produto encontrado']);
        }
    }

    public function getProduto($id){
        $produto = Produto::where('id', $id)->first();

        if($produto != null){
            return response()->json(['error' => '', 'data' => $produto]);
        }
        else{
            return response()->json(['error' => 'Produto não encontrado']);
        }
    }

    //fim

    //Funções de pedidos

    public function fazerPedido(Request $request){       

        $endereco_ativo = Endereco::where('id_cliente', $request->id_cliente)->where('status', true)->first();

        if($endereco_ativo == null){
            return response()->json(['error' => 'endereco', 'mensagem' => 'Sem um endereço ativo, você não pode fazer pedidos, ative um novo endereço e tente novamente!']);
        }
        else{
            $pedido = Pedido::create([
                'id_cliente' => $request->id_cliente,
                'valor' => $request->valor,
                'status' => $this->aguardando, 
                'pagamento' => intval($request->pagamento),
                'troco' => floatval($request->troco)
            ]);
    
            foreach($request->array as $key => $item){
                PedidoProduto::create([
                    'id_produto' => $item['id'],
                    'id_pedido' => $pedido->id,
                    'quantidade' => $item['qtde']
                ]);
            }
    
            return response()->json(['error' => '', 'mensagem' => 'Pedido enviado com sucesso!']);
        }
    }

    public function getPedidos($id){
        $pedidos = Pedido::with('produtos')->where('id_cliente', $id)->orderBy('status', 'ASC')->get();

        if($pedidos->count() > 0){
            return response()->json(['error' => '', 'pedidos' => $pedidos]);
        }
        else{
            return response()->json(['error' => 'true', 'mensagem' => 'Opss... Parece que você ainda não fez pedidos :(']);
        }

    }

    public function getPedido($id){
        $pedido = Pedido::find($id);
        $pedido->produtos;

        if($pedido){
            return response()->json(['error' => '', 'pedido' => $pedido]);
        }
        else{
            return response()->json(['error' => 'true', 'mensagem' => 'Parece que este pedido não existe!']);
        }
    }

    public function confirmaEntrega($id){
        $pedido = Pedido::where('id', $id)->update([
            'status' => 3
        ]);

        if($pedido){
            return response()->json(['error' => '', 'mensagem' => 'Obrigado por nos informar!']);
        }
        else{
            return response()->json(['error' => 'true', 'mensagem' => 'Ocorreu um erro ao confirmar sua entrega!']);
        }
    }

    //fim

    //Funções de clientes

    public function validarCliente($id){
        $cliente = Cliente::where('id', $id)->first();

        if($cliente !== null){
            return response()->json(['status'=> 'true', 'mensagem' => 'Cliente inválido', 'cliente' => $cliente]);
        }
        else{
            return response()->json(['status'=> 'false', 'mensagem' => 'Cliente inválido']);
        }
    }

    //fim

    public function teste(){
        $pedidos = DB::table('pedidos')->select('id', 'valor', 'troco', 'created_at', DB::raw('CASE WHEN status = 0 THEN "Aguardando" WHEN status = 1 THEN "Preparando" WHEN status = 2 THEN "Saiu para entrega" WHEN status = 3 THEN "Entregue" WHEN status = 4 THEN "Cancelado" ELSE "Devolvido" END AS status'), DB::raw('CASE WHEN pagamento = 1 THEN "Cartão de Crédito" WHEN pagamento = 2 THEN "Dinheiro sem troco" ELSE "Dinheiro com troco" END AS pagamento'))->get();
        
        return response()->json($pedidos); 
    }

}
