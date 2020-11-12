<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Registrar-se | Enjoy Sushi Delivery</title>
  <link href="{{asset('imports/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7" style="margin: 0 auto">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crie uma conta!</h1>
              </div>
              <form class="user" action="/registrar/salvar" method="post">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" placeholder="Nome completo">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Endereço de e-mail">
                  @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control @error('senha') is-invalid @enderror" id="senha" name="senha" placeholder="Senha">
                    @error('senha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control @error('confirma_senha') is-invalid @enderror" id="confirma_senha" name="confirma_senha" placeholder="Confirme a senha">
                    @error('confirma_senha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <button class="btn btn-primary btn-block">
                  Cadastrar-se
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="login.html">Já tem uma conta? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('imports/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('imports/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('imports/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>
</html>
