<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('dashboard.home');
        }

        return redirect()->route('login');
    }

    public function mostrarLogin(){
        return view('admin.login');
    }

    public function login(Request $request){
        $validacao = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'senha' => 'required|min:6|max:16'
        ]);

        if($validacao->fails()){
            return redirect()->back()->withInput()->withErrors($validacao->errors());
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->senha])){
            return redirect()->route('home');
        }

        return redirect()->back()->withInput()->withErrors(['Ocorreu um erro durante o Login!']);
    }

    public function sair(){
        Auth::logout();

        return redirect()->route('home');
    }

    public function mostrarCadastro(){
        return view('admin.registrar');
    }

    public function cadastrar(Request $request){
        $validacao = Validator::make($request->all(), [
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'email'=> 'required|email|max:100|unique:usuarios',
            'senha'=> 'required|min:6|max:16',
            'confirma_senha' => 'required|min:6|max:16|same:senha'
        ]);

        if($validacao->fails()){
            return redirect()->back()->withInput()->withErrors($validacao->errors());
        }

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha'=> Hash::make($request->senha),
            'status' => 1
        ]);
        
        if($usuario){
            if(Auth::attempt(['email' => $usuario->email, 'password' => $request->senha])){
                return redirect()->route('home');
            }
            else{
                return redirect()->back()->withInput()->withErrors(['Ocorreu um erro durante o Login!']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['Ocorreu um erro durante o cadastro']);
    }
}
