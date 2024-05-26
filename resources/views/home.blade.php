@extends('layout.template')
@section('title', 'Gestão de Património ENDE-Imóvel')
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

@section('content')
<div class="row">
    <h2>Bem-Vindo</h2>
</div>
<div class="row">
    @can('gestor imovel')
    <div class="col-lg-6 card">
        <canvas id="ChartImovel" width="400" height="400"></canvas>
    </div>
   
    @endcan

    @can('gestor movel')
   
   

    <div class="col-lg-6 card">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <div class="col-lg-6 card">
        <canvas id="myChart2" width="400" height="400"></canvas>
    </div>

   
    @endcan

    @can('gestor de veiculo')
    <div class="col-lg-6 card">
        <canvas id="myChartveiculo" width="400" height="400"></canvas>
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
    
   

   //
   //veiculo
// Definindo os valores dos veículos registrados e em reparação
// Definindo os valores dos veículos registrados e em reparação
@can('gestor imovel')


  
    var TotalTerreno = {{$TotalTerrenos}};
    var Totalresidencia = {{$TotalResidencias}};
    var TotalEdificios={{$TotalEdificios}}
    var imoveisRegistrados=TotalTerreno+Totalresidencia+TotalEdificios;

    // Calculando o total de veículos
    //var totalVeiculos = veiculosRegistrados + veiculosAbatidos + veiculosAtivos;

    // Obtendo o contexto do elemento canvas
    var chartImovel = document.getElementById('ChartImovel').getContext('2d');

    // Criando o gráfico de barra
    var myChart = new Chart(chartImovel, {
        type: 'bar',
        data: {
            labels: ['Imóveis registados', 'Terrenos', 'Edifícios', 'Residencias'],
            datasets: [{
                label: 'Valores',
                data: [imoveisRegistrados,TotalTerreno , TotalEdificios, Totalresidencia],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Cor da primeira barra
                    'rgba(54, 162, 235, 0.6)', // Cor da segunda barra
                    'rgba(255, 206, 86, 0.6)' // Cor da terceira barra
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Cor da borda da primeira barra
                    'rgba(54, 162, 235, 1)', // Cor da borda da segunda barra
                    'rgba(255, 206, 86, 1)' // Cor da borda da terceira barra
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Imóveis',
                    font: {
                        size: 14,
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



@endcan

@can('gestor de veiculo')

    var veiculosRegistrados = {{$totalVeiculo}};
    var veiculosAbatidos = {{$veiculosabatidos}};
    var veiculosAtivos = {{$veiculosAtivo}};

    // Calculando o total de veículos
    //var totalVeiculos = veiculosRegistrados + veiculosAbatidos + veiculosAtivos;

    // Obtendo o contexto do elemento canvas
    var ctx = document.getElementById('myChartveiculo').getContext('2d');

    // Criando o gráfico de barra
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Veiculos registados', 'Veiculos abatidos', 'Veiculos Ativos'],
            datasets: [{
                label: 'Valores',
                data: [veiculosRegistrados, veiculosAbatidos, veiculosAtivos],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Cor da primeira barra
                    'rgba(54, 162, 235, 0.6)', // Cor da segunda barra
                    'rgba(255, 206, 86, 0.6)' // Cor da terceira barra
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Cor da borda da primeira barra
                    'rgba(54, 162, 235, 1)', // Cor da borda da segunda barra
                    'rgba(255, 206, 86, 1)' // Cor da borda da terceira barra
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Veículos',
                    font: {
                        size: 14,
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


@endcan



@can('gestor movel')
   //________________
   var ctx = document.getElementById('myChart').getContext('2d');
   var chartMatEletronico = document.getElementById('myChart2').getContext('2d');
   var totalMatEscritorio={{$totalMatEscritorio}};
   var materialEscritorioAtivo={{$materialEscritorioAtivo}};
   var TotalMaterialEscritorioAbatido={{$TotalMaterialEscritorioAbatido}};
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Material de escritório Registado','Material de escritorio activo','Material de escritório abatido' ],
        datasets: [{
            label: 'Valores',
            data: [totalMatEscritorio,materialEscritorioAtivo,TotalMaterialEscritorioAbatido],
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
                    size: 14,
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

//mat eletronico
 var TotalMaterialEletronico={{$TotalMaterialEletronico}};
 var TotalMaterialEletronicoAtivo={{$TotalMaterialEletronicoAtivo}};
 var totalMaterialEletronicoAbatido={{$totalMaterialEletronicoAbatido}};

var myCh = new Chart(chartMatEletronico, {
    type: 'bar',
    data: {
        labels: ['material electr+onico registados','material electrónico ativos', 'material electrónico abatidos' ],
        datasets: [{
            label: 'Valores',
            data: [TotalMaterialEletronico, TotalMaterialEletronicoAtivo,totalMaterialEletronicoAbatido],
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
                text: 'Materais Electronicos',
                font: {
                    size: 14,
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

@endcan





</script>
@endsection