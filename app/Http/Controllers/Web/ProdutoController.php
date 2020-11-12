<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index(){
        return view('dashboard.cadastrar_produtos');
    }

    public function salvar(Request $request){

        $validacao = Validator::make($request->all(), [
            'nome' => 'required|regex:/[a-zA-Z0-9\s]+/|max:100|unique:produtos',
            'descricao' => 'required|regex:/[a-zA-Z0-9\s]+/|max:255',
            'valor' => 'required|numeric|max:9999',
            'imagem' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if($validacao->fails()){
            return ['status'=> false,"validacao"=> true, "erros"=> $validacao->errors()];
        }
        else{
            if($request->hasFile('imagem')){
                $arquivo = $request->file('imagem');
                $extensao = $arquivo->getClientOriginalExtension();
                $nome_arquivo = time().'.'.$extensao;
                $arquivo->move('storage/produtos/', $nome_arquivo);
            }

            $produto = Produto::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'valor' => $request->valor,
                'imagem' => 'storage/produtos/'.$nome_arquivo,
            ]);

            return ['status'=> true, 'mensagem' => 'Produto cadastrado com sucesso!', 'codigo' => $produto->id];
        }
    }

    public function lista(){
        $lista_de_produtos = Produto::where('status', '=', true)->get();
        
        return view('dashboard.lista_produtos', compact('lista_de_produtos', $lista_de_produtos));
    }

    public function editar($id){
        $produto = Produto::find($id);

        return view('dashboard.cadastrar_produtos', compact('produto', $produto));
    }

    public function atualizar(Request $request){
        $produto = Produto::find($request->route('id'));

        $validacao = Validator::make($request->all(), [
            'nome' => $request->nome != $produto->nome ? 'required|regex:/[a-zA-Z0-9\s]+/|max:100|unique:produtos' : '',
            'descricao' => 'required|regex:/[a-zA-Z0-9\s]+/|max:255',
            'valor' => 'required|numeric|max:9999',
            'imagem' => $request->imagem == 'undefined'? '' : 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if($validacao->fails()){
            return ['status'=> 'validacao', "validacao"=> true, "erros"=> $validacao->errors()];
        }
        else{

            if($request->hasFile('imagem')){
                $arquivo = $request->file('imagem');
                $extensao = $arquivo->getClientOriginalExtension();
                $nome_arquivo = time().'.'.$extensao;
                $arquivo->move('storage/produtos/', $nome_arquivo);
            }

            Produto::find($request->route('id'))->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'valor' => $request->valor,
                'imagem' => $request->imagem == 'undefined'? $produto->imagem : 'storage/produtos/'.$nome_arquivo,
            ]);

            return ['status'=> 'sucesso', 'mensagem' => 'Dados atualizados com sucesso.'];
        }
    }

    public function excluir($id){
        $row = Produto::where('id', '=', $id)->count();

        if($row > 0){
            Produto::where('id', '=', $id)->update([
                'status' => 0
            ]);

            return redirect()->back()->with('mensagem', 'Produto excluido com sucesso!');
        }
        else{
            return redirect()->back()->with('mensagem', 'Este produto não existe!');
        }
    }

    public function dashboardProdutos(){
        $lista = Produto::where('status', true)->count();

        if($lista > 0){
            return response()->json(['status' => 'true', 'produtos' => $lista]);
        }
        else{
            return response()->json(['status' => 'false', 'mensagem' => 'Nenhum produto cadastrado!']);
        }
    }
}
