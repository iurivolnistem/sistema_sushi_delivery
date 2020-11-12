@extends('layout.principal')

@section('titulo', 'Dashboard | Enjoy Sushi')

@section('conteudo')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganhos do mês atual</div>
              <div id="dash_ganhos_mes" class="h5 mb-0 font-weight-bold text-gray-800">R$ </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de entradas do Ano</div>
              <div id="dash_ganhos" class="h5 mb-0 font-weight-bold text-gray-800">R$ </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cardápios</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div id="dash_cardapios" class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Clientes cadastrados</div>
              <div id="dash_clientes" class="h6 mb-0 font-weight-bold text-gray-800"></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Entradas por mês</h6>
        </div>
        <div class="card-body">
          <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="myBarChart" width="1037" height="320" class="chartjs-render-monitor" style="display: block; width: 1037px; height: 320px;"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Situação dos pedidos</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle" style="color: #4e73df"></i> Aguardando
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: #FA7921"></i> Saiu p/ entrega
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: #f6c23e"></i> Preparando
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: #1cc88a"></i> Entregue
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="_token" value="{{csrf_token()}}">
@endsection

@section('scripts')
<script src="{{ asset('js/app.home.js') }}"></script>
<script src="{{ asset('imports/chart.js/Chart.min.js') }}"></script>
@endsection