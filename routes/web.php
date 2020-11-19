<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'Web\\AuthController@mostrarLogin')->name('login');
Route::post('/login/entrar', 'Web\\AuthController@login')->name('login.entrar');
Route::get('/registrar', 'Web\\AuthController@mostrarCadastro');
Route::post('/registrar/salvar', 'Web\\AuthController@cadastrar');
Route::get('/', function(){
    return redirect('/home');
});
Route::get('/home', 'Web\\AuthController@index')->name('home');
Route::get('/home/sair', 'Web\\AuthController@sair')->name('home.sair');

Route::middleware(['auth'])->group(function (){
    Route::get('/buscar/clientes', 'Web\\ClienteController@dashboardClientes');
    Route::get('/buscar/produtos', 'Web\\ProdutoController@dashboardProdutos');
    Route::get('/pedido/informacao/{id}', 'Web\PedidoController@buscarPedido');
    Route::get('/lista/clientes', 'Web\\ClienteController@lista');
    Route::get('/excluir/cliente/{id}', 'Web\\ClienteController@excluir');
    Route::get('/ativar/cliente/{id}', 'Web\\ClienteController@ativarCliente');
    Route::get('/exportar/clientes', 'Web\\ClienteController@exportar');

    Route::get('/buscar/pedidos/soma', 'Web\\PedidoController@somarPedidos');
    Route::get('/buscar/pedidos/status', 'Web\\PedidoController@getPedidosStatus');
    Route::get('/buscar/entradas/mes', 'Web\PedidoController@getEntradasMes');
    Route::get('/soma/entradas/mes', 'Web\PedidoController@somarPedidosMes');
    Route::get('/lista/pedidos', 'Web\\PedidoController@buscarPedidos');
    Route::get('/cancelar/pedido/{id}', 'Web\\PedidoController@cancelar');
    Route::get('/nova-etapa/pedido/{id}', 'Web\\PedidoController@proximaEtapa');
    Route::get('/registro/pedidos', 'Web\\PedidoController@registro');
    Route::get('/exportar/pedidos', 'Web\\PedidoController@exportar');

    Route::get('/cadastrar/produtos', 'Web\\ProdutoController@index');
    Route::post('/cadastrar/produtos', 'Web\\ProdutoController@salvar');
    Route::get('/lista/produtos', 'Web\\ProdutoController@lista');
    Route::get('/editar/produto/{id}', 'Web\\ProdutoController@editar');
    Route::post('/editar/produto/{id}', 'Web\\ProdutoController@atualizar');
    Route::get('/excluir/produto/{id}', 'Web\\ProdutoController@excluir');
    Route::get('/exportar/produtos', 'Web\\ProdutoController@exportar');
});
