@extends('layout.principal')
@section('titulo', 'Visualizar Pedidos | Enjoy Sushi')

@section('css')
    <link rel="stylesheet" href="{{asset('css/pedido.css')}}">
@endsection

@section('conteudo')

@if(isset($aguardando) && isset($preparando) && isset($saiu) && isset($entregue))
    <div class="row">
        <div class="col-md-12">
            <h4 class="font-weight-bold text-primary">Pedidos</h4>
        </div>
    </div>
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-md-3 column">
            <div class="card card-item">
                <div class="card-header text-center">
                    <h5>Aguardando</h5>
                </div>
                <div class="card-body">
                    @foreach($aguardando as $key => $item)
                        <div class="card card-pedido">
                            <div class="card-body ">
                                <div class="pedido">
                                Pedido: #{{$item->id}} 
                                <span class="status @if($item->status === 'Aguardando') aguardando @elseif($item->status === 'Saiu') saiu @elseif($item->status === 'Preparo') preparo @elseif($item->status === 'Entregue') entregue @endif "></span>
                                </div>
                                <div class="buttons">
                                    <button class="btn btn-info openBtn" data-pedido="{{$item->id}}"><i class="fas fa-info-circle"></i></button>
                                    @if($item->status !== 'Entregue' && $item->status !== 'Saiu')
                                        <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                        <button href="" class="btn btn-success"><i class="fas fa-arrow-circle-right"></i></button>
                                    @endif
                                </div>
                                <div class="horario">
                                    <small>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="card card-item">
                <div class="card-header text-center">
                    <h5>Preparando</h5>
                </div>
                <div class="card-body">
                    @foreach($preparando as $key => $item)
                        <div class="card card-pedido">
                            <div class="card-body">
                                <div class="pedido">
                                Pedido: #{{$item->id}} 
                                <span class="status @if($item->status === 'Aguardando') aguardando @elseif($item->status === 'Saiu') saiu @elseif($item->status === 'Preparo') preparo @elseif($item->status === 'Entregue') entregue @endif "></span>
                                </div>
                                <div class="buttons">
                                    <button class="btn btn-info openBtn" data-pedido="{{$item->id}}"><i class="fas fa-info-circle"></i></button>
                                    @if($item->status !== 'Entregue' && $item->status !== 'Saiu')
                                        <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                        <button href="" class="btn btn-success"><i class="fas fa-arrow-circle-right"></i></button>
                                    @endif
                                </div>
                                <div class="horario">
                                    <small>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="card card-item">
                <div class="card-header text-center">
                    <h5>Saiu para entrega</h5>
                </div>
                <div class="card-body">
                    @foreach($saiu as $key => $item)
                        <div class="card card-pedido">
                            <div class="card-body">
                                <div class="pedido">
                                Pedido: #{{$item->id}} 
                                <span class="status @if($item->status === 'Aguardando') aguardando @elseif($item->status === 'Saiu') saiu @elseif($item->status === 'Preparo') preparo @elseif($item->status === 'Entregue') entregue @endif "></span>
                                </div>
                                <div class="buttons">
                                    <button class="btn btn-info openBtn" data-pedido="{{$item->id}}"><i class="fas fa-info-circle"></i></button>
                                    @if($item->status !== 'Entregue' && $item->status !== 'Saiu')
                                        <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                        <button href="" class="btn btn-success"><i class="fas fa-arrow-circle-right"></i></button>
                                    @endif
                                </div>
                                <div class="horario">
                                    <small>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 column">
            <div class="card card-item">
                <div class="card-header text-center">
                    <h5>Entregue</h5>
                </div>
                <div class="card-body">
                    @foreach($entregue as $key => $item)
                        <div class="card card-pedido">
                            <div class="card-body">
                                <div class="pedido">
                                Pedido: #{{$item->id}} 
                                <span class="status @if($item->status === 'Aguardando') aguardando @elseif($item->status === 'Saiu') saiu @elseif($item->status === 'Preparo') preparo @elseif($item->status === 'Entregue') entregue @endif "></span>
                                </div>
                                <div class="buttons">
                                    <button class="btn btn-info openBtn" data-pedido="{{$item->id}}"><i class="fas fa-info-circle"></i></button>
                                    @if($item->status !== 'Entregue' && $item->status !== 'Saiu')
                                        <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                        <button href="" class="btn btn-success"><i class="fas fa-arrow-circle-right"></i></button>
                                    @endif
                                </div>
                                <div class="horario">
                                    <small>{{date('d/m/Y - H:i', strtotime($item->created_at))}}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pedido #4</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                   <div id="conteudo-pedido">
                       <div id="todos-produtos"></div>
                       <h4 id="pedido-valor"></h4>
                        {{-- <div id="pedido-cliente"></div> --}}
                        <div id="pedido-endereco" class="text-justify"></div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script src="{{asset('/js/pedido/app.pedido.js')}}"></script>
@endsection
