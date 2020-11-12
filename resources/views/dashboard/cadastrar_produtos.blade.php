@extends('layout.principal')

@if(isset($produto))
    @section('titulo', 'Atualizar produto | Enjoy Sushi')
@else
    @section('titulo', 'Cadastrar produto | Enjoy Sushi')
@endif

@section('css')
<link rel="stylesheet" href="{{asset('css/produto.css')}}">
@endsection

@section('conteudo')

@if(isset($produto))

<div class="row">
    <div class="col-lg-8" style="margin: 0 auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Atualizar produto</h6>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="produto" name="produto" value="{{$produto->id}}">
                    <div class="form-group row">
                        <div class="col-sm-4 imgUp" style="margin: 0 auto;">
                            <div class="imagePreview" style="background-image: url('{{asset($produto->imagem)}}')"></div>
                            <label class="btn btn-primary">
                                Upload<input type="file" class="uploadFile img" id="imagem" name="imagem"
                                    style="width: 0px;height: 0px;overflow: hidden;" value="{{$produto->imagem}}">
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-12 mb-3" style="margin-bottom: 1rem">
                                <input type="text" class="form-control form-control-user"
                                    id="nome" name="nome" placeholder="Nome do produto" maxlength="100" value="{{ $produto->nome }}">
                            </div>
                            <div class="col-sm-12 mb-3">
                                <textarea class="form-control" placeholder="Descrição do produto" maxlength="255" id="descricao" name="descricao">{{$produto->descricao}}</textarea>
                            </div>
                            <div class="col-sm-12 mb-3" style="margin-bottom: 1rem ">
                                <input type="text" class="form-control form-control-user"
                                    id="valor" name="valor" placeholder="Valor do produto" maxlength="100"
                                    value="{{ $produto->valor }}">
                            </div>
                            <div class="col-sm-12">
                                <button type="button" id="btnAtualizar" class="form-control btn btn-success" style="margin-bottom: 1rem">Atualizar</button>
                            </div>
                            <div class="col-sm-12">
                                <a href="#" class="form-control btn btn-warning" style="margin-bottom: 1rem">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@else

<div class="row">
    <div class="col-lg-8" style="margin: 0 auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cadastrar produto</h6>
            </div>
            <div class="card-body">
                <form action="/cadastrar/produtos/salvar" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <div class="col-sm-4 imgUp" style="margin: 0 auto;">
                            <div class="imagePreview"></div>
                            <label class="btn btn-primary">
                                Upload<input type="file" class="uploadFile img" id="imagem" name="imagem"
                                    style="width: 0px;height: 0px;overflow: hidden;">
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-12 mb-3" style="margin-bottom: 1rem">
                                <input type="text" class="form-control form-control-user"
                                    id="nome" name="nome" placeholder="Nome do produto" maxlength="100">
                            </div>
                            <div class="col-sm-12 mb-3">
                                <textarea class="form-control" placeholder="Descrição do produto" maxlength="255" id="descricao" name="descricao"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3" style="margin-bottom: 1rem ">
                                <input type="text" class="form-control form-control-user"
                                    id="valor" name="valor" placeholder="Valor do produto" maxlength="100">
                            </div>
                            <div class="col-sm-12">
                                <button type="button" id="btnCadastrar" class="form-control btn btn-success" style="margin-bottom: 1rem">Cadastrar</button>
                            </div>
                            <div class="col-sm-12">
                                <a href="#" class="form-control btn btn-warning" style="margin-bottom: 1rem">Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endif

@endsection

@section('scripts')
<script src="{{asset('imports/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/js/produto/app.produto.js')}}"></script>
@endsection
