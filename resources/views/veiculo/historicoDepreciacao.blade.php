@extends('layout.template')
@section('title', 'Material Escritório')


@section('content')

                    <div class="card">
                                    <h3 class="card-header">Histórico de Depreciação</h3>
                                    @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                    @endif

                                    @if(isset($erro))
                                    <div class="alert alert-danger" id="erro-registar">
                                        <p>{{$erro}}</p>
                                    </div>
                                        
                                    @endif

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                    <div class="table-responsive">
                                                        <h4 class="text-center">Dados de depreciação</h4>
                                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Codigo Veiculo</th>
                                                                    <th>Valor do Ativo</th>
                                                                    <th>Valor Residual</th>
                                                                    <th>Vida útil</th>
                                                                    <th>Depreciação Anual</th>
                                                                    <th>Data Inicio Utilização</th>
                                                                    
                                                                    
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($dep))
                                                                    @foreach($dep as $d)
                                                                <tr>
                                                                    <td>{{$d->numeroimovel}}</td>
                                                                    <td>{{number_format($d->valoraquisicao, 2, ',', '.')}}</td>
                                                                    <td>{{number_format($d->valorresidual, 2, ',', '.')}}</td>
                                                                    <td>{{$d->vidautil}} ano(s)</td>                                                                  
                                                                    <td>{{number_format($d->dp_anual, 2, ',', '.')}}</td>
                                                                    <td>{{$d->datainicio}}</td>
                                                                    
                                                                    
                                                                   
                                                                   
                                                                    
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                   
                                                    
                                      
                                       
                                    </div>

                                    <div class="card">

                                        <p class="ml-2 mt-2">Vida util restante: <strong>{{$vidautilRestante}} Anos (s)</strong></p>
                                        <p class="ml-2">Valor Contábil:  <strong>{{number_format($dado['valor_contabil'], 2, ',', '.')}}</strong></p>
                                        <p class="ml-2"> Depreciação Acumulada: <strong>{{number_format($dado['depreciacao_acumulada'], 2, ',', '.')}}</strong></p>

                                    </div>
                    </div>






 <script>

$(document).ready(function(){
    
});



  //validação transferir

               



 </script>
@endsection