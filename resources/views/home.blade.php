@extends('layout.template')
@section('title', 'Gestão de Património ENDE-Imóvel')


@section('content')
<div class="row">
    <h2>Bem-Vindo</h2>
</div>
<div class="row">
    @can('gestor imovel')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco"> Imóveis</h5>

                    
                </div>
            </div>
        </a> 
    </div>

   
    @endcan

    @can('gestor movel')
   
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <a class="" data-target="#submenu-2" aria-controls="submenu-2" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Móveis</h5>
                </div>
            </div>
        </a> 
    </div>

    <div class="col-lg-6">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    @endcan

    @can('gestor de veiculo')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a data-target="#submenu-3" aria-controls="submenu-3" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Veículos</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

    @can('admin')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Configurações</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

</div>


<div class="row">
    
   
   @can('técnico veículo')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a class="" data-target="#submenu-2" aria-controls="submenu-2" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Tecníco veículo</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

    @can('técnico movel')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a  data-target="#submenu-3" aria-controls="submenu-3" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Tecníco Móveis</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan
   
   

</div>

<script>
    /*
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($mat as $m)
                    '{{ $m->descricao }}',
                @endforeach
            ],
            datasets: [{
                label: 'Valores',
                data: [
                    @foreach($mat as $m)
                        {{ $m->valor_aquisicao }},
                    @endforeach
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });*/

   //
   var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($mat as $m)
            '{{ $m->tipo }}',
            @endforeach
        ],
        datasets: [{
            label: 'Valores',
            data: [
                @foreach($mat as $m)
                {{ $m->valor_aquisicao }},
                @endforeach
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // Cor da primeira barra
                'rgba(54, 162, 235, 0.6)', // Cor da segunda barra
                'rgba(255, 206, 86, 0.6)', // Cor da terceira barra
                'rgba(75, 192, 192, 0.6)', // Cor da quarta barra
                'rgba(153, 102, 255, 0.6)' // Cor da quinta barra
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Cor da borda da primeira barra
                'rgba(54, 162, 235, 1)', // Cor da borda da segunda barra
                'rgba(255, 206, 86, 1)', // Cor da borda da terceira barra
                'rgba(75, 192, 192, 1)', // Cor da borda da quarta barra
                'rgba(153, 102, 255, 1)' // Cor da borda da quinta barra
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Materais de Escritório',
                font: {
                    size: 20,
                    weight: 'bold'
                }
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    font: {
                        size: 14
                    }
                }
            }
        },
        layout: {
            padding: {
                left: 50,
                right: 50,
                top: 50,
                bottom: 50
            }
        },
        scales: {
            x: {
                grid: {
                    display: false // Remover as linhas de grade internas do eixo x
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    display: false // Remover as linhas de grade internas do eixo y
                }
            }
        }
    }
});

</script>
@endsection