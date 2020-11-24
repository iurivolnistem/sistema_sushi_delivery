<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Rotas para cadastro e login
Route::post('/auth/login', 'Api\\AuthController@login');
Route::post('/cadastrar', 'Api\\AuthController@cadastrar');
//fim

//rotas para cliente
Route::get('/validar/{id}', 'Api\\ApiController@validarCliente');
//fim

//rotas para produtos
Route::get('/produtos', 'Api\\ApiController@getProdutos');
Route::get('/produto/{id}', 'Api\\ApiController@getProduto');
//fim

//rotas para endereço
Route::get('/enderecos/cliente/{id}', 'Api\\ApiController@getEnderecos');
Route::post('/endereco/ativo/{id}/{id_cliente}', 'Api\\ApiController@changeEnderecoAtivo');
Route::post('/cadastrar/endereco', 'Api\\ApiController@cadastrarEndereco');
Route::get('/excluir/endereco/{id}/{id_cliente}', 'Api\\ApiController@excluirEndereco');
//fim

//rotas para telefone
Route::get('/telefones/cliente/{id}', 'Api\\ApiController@getTelefones');
Route::post('/cadastrar/telefone', 'Api\ApiController@cadastrarTelefone');
Route::post('/telefone/ativo/{id}/{id_cliente}', 'Api\\ApiController@changeTelefoneAtivo');
Route::get('/excluir/telefone/{id}/{id_cliente}', 'Api\ApiController@excluirTelefone');
//fim

//rotas para pedidos
Route::get('/pedidos/cliente/{id}', 'Api\\ApiController@getPedidos');
Route::get('/pedido/{id}', 'Api\\ApiController@getPedido');
Route::get('/pedido/confirmarEntrega/{id}', 'Api\\ApiController@confirmaEntrega');
Route::post('/pedido', 'Api\\ApiController@fazerPedido');
Route::get('/cancelar/pedido/{id}', 'Api\\ApiController@cancelar');
//fim

Route::get('/verificar/horario', 'Api\\ApiController@horarioFuncionamento');
