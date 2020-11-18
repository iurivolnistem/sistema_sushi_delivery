@extends('layout.principal')

@section('titulo', 'Lista de pedidos | Enjoy Sushi')

@section('css')
<link rel="stylesheet" href="{{asset('css/tabelas.css')}}">
@endsection

@section('conteudo')

@if($lista_pedidos->count() == 0)

<div class="row">
    <div class="col-md-8" style="margin: 0 auto">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tabela de pedidos</h6>
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
      <h6 class="m-0 font-weight-bold text-primary">Tabela de pedidos</h6>
      <button id="btnExportar" class="btn btn-success">Exportar para excel</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="pedidos_table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Sitação</th>
                <th>Forma de Pagamento</th>
                <th>Troco</th>
                <th>Valor</th>
                <th>Horário</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lista_pedidos as $key => $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>@if($item->status == 0) Aguardando @elseif($item->status == 1) Preparando @elseif($item->status == 2) Saiu para entrega @elseif($item->status == 3) Entregue @elseif($item->status == 4) Cancelado @else Devolvido @endif</td>
                <td>@if($item->pagamento == 1) Cartão de Crédito @elseif($item->pagamento == 2) Dinheiro sem troco @elseif($item->pagamento == 3) Dinheiro com troco @else Outro @endif</td>
                <td>{{$item->troco == 0 || $item->troco == '' ? '-' : 'R$ '.$item->troco}}</td>
                <td>R$ {{$item->valor}}</td>
                <td>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</td>
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
<script src="{{asset('/js/pedido/tabela.js')}}"></script>
<script src="{{ asset('/imports/sweetalert/sweetalert2.all.min.js') }}"></script>
@endsection