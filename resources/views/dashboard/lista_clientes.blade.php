@extends('layout.principal')

@section('titulo', 'Lista de clientes | Enjoy Sushi')

@section('css')
<link rel="stylesheet" href="{{asset('css/tabelas.css')}}">
@endsection

@section('conteudo')

@if($lista_clientes->count() == 0)

<div class="row">
    <div class="col-md-8" style="margin: 0 auto">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tabela de clientes</h6>
            </div>
            <div class="card-body">
                <h5 class="font-weight-bold">Nenhum cliente cadastrado!</h5>
            </div>
        </div>
    </div>
</div>

@else

<div class="card shadow mb-4">
    <div class="card-header py-3" style="display: flex; align-items: center;justify-content: space-between;">
      <h6 class="m-0 font-weight-bold text-primary">Tabela de clientes</h6>
      <button id="btnExportar" class="btn btn-success">Exportar para excel</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="clientes_table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Data de criação</th>
                <th>Situação</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lista_clientes as $key => $item)
              <tr>
                <td>{{$item->nome}}</td>
                <td>{{$item->cpf}}</td>
                <td>{{$item->email}}</td>
                <td>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</td>
                <td>{{$item->status == true ? 'Ativo' : 'Inativo'}}</td>
                <td class="text-center">
                    @if($item->status == true)
                      <a href="/excluir/cliente/{{$item->id}}" class="btn btn-danger">Excluir</a>
                    @elseif($item->status == false)
                    <a href="/ativar/cliente/{{$item->id}}" class="btn btn-info">Ativar</a>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
    @if (session()->has('mensagem'))
      <h4 class="alert alert-info text-center">{{ session('mensagem') }}</h4>
    @endif

@endif
@endsection

@section('scripts')
<script src="{{asset('/imports/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/imports/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/cliente/tabela.js')}}"></script>
<script src="{{ asset('/imports/sweetalert/sweetalert2.all.min.js') }}"></script>
@endsection