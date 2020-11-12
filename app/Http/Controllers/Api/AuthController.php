<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function cadastrar(Request $request){
        $validacao = Validator::make($request->all(), [
            'nome'           => 'required|regex:/^[a-zA-Z ]*$/|max:100',
            'cpf'            => 'required|max:14|unique:clientes',
            'email'           => 'required|email|max:100|unique:clientes',
            'senha'           => 'required|min:6|max:14',
            'confirma_senha' => 'required|min:6|max:14|same:senha'
        ]);

        if($validacao->fails()){
            return ['status'=> 'validacao', "erros"=> $validacao->errors()];
        }
        else{
            $cliente = Cliente::create([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'email' => $request->email,
                'senha' => Hash::make($request->senha)
            ]);
            
            return ['status'=> 'sucesso', 'mensagem' => 'Cliente cadastrado com sucesso!', 'cliente' => $cliente];
        }
    }

    public function login(Request $request){
        $validacao = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'senha' => 'required|min:6|max:16'
        ]);

        if($validacao->fails()){
            return ['status' => 'validacao', 'erros' => $validacao->errors()];
        }

        $cliente = Cliente::where('email', '=', $request->email)->first();

        if($cliente != null){
            if($request->email == $cliente->email && Hash::check($request->senha, $cliente->senha)){
                return response()->json(['status' => 'sucesso', 'mensagem' => 'Login efetuado com sucesso', 'cliente' => $cliente]);
            }
            else{
                return response()->json(['status' => 'erro', 'mensagem' => 'Os dados de login ou senha estão incorretos!']);
            }
        }
        else{
            return response()->json(['status' => 'erro', 'mensagem' => 'Os dados de login ou senha estão incorretos!']);
        }
    }
}
