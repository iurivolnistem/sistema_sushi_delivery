@extends('layout.principal')

@section('titulo', 'Lista de produtos | Enjoy Sushi')

@section('css')
<link rel="stylesheet" href="{{asset('css/tabelas.css')}}">
@endsection

@section('conteudo')

@if($lista_de_produtos->count() == 0)

<div class="row">
    <div class="col-md-8" style="margin: 0 auto">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tabela de produtos</h6>
            </div>
            <div class="card-body">
                <h5 class="font-weight-bold">Nenhum produto cadastrado!</h5>
                <a href="/cadastrar/produtos" class="btn btn-primary">Novo produto</a>
            </div>
        </div>
    </div>
</div>

@else

<div class="card shadow mb-4">
    <div class="card-header py-3" style="display: flex; align-items: center;justify-content: space-between;">
      <h6 class="m-0 font-weight-bold text-primary">Tabela de produto</h6>
      <button id="btnExportar" class="btn btn-success">Exportar para excel</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="produtos_table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Data de criação</th>
                <th>Ultima atualização</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lista_de_produtos as $key => $item)
              <tr>
                <td class="imagem"><img src="{{asset($item->imagem)}}" alt=""></td>
                <td>{{$item->nome}}</td>
                <td>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</td>
                <td>{{date('d/m/Y - H:i', strtotime($item->updated_at))}}</td>
                <td class="text-center">
                    <a href="/editar/produto/{{$item->id}}" class="btn btn-warning">Editar</a>
                    <a href="/excluir/produto/{{$item->id}}" class="btn btn-danger">Excluir</a>
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
<script src="{{asset('/js/produto/tabela.js')}}"></script>
<script src="{{ asset('/imports/sweetalert/sweetalert2.all.min.js') }}"></script>
@endsection