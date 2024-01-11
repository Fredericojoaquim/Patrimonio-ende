@extends('layout.template')
@section('title', 'Material Escritório')


@section('content')

                    <div class="card">
                                    <h3 class="card-header">Listar Material Escritório</h3>
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
                                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nº Mobilizado</th>
                                                                    <th>Tipo</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Tipo Aquisição</th>
                                                                    <th>Cor</th>
                                                                    <th>Departamento</th>
                                                                    <th>Data Aquisição</th>
                                                                    <th>Vida útil</th>
                                                                    <th>Estado</th>
                                                                    
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($mat))
                                                                    @foreach($mat as $m)
                                                                <tr>
                                                                    <td>{{$m->id}}</td>
                                                                    <td>{{$m->num_mobilizado}}</td>
                                                                    <td>{{$m->tipo}}</td>
                                                                    <td>{{$m->valor_aquisicao}}</td>
                                                                    <td>{{$m->tipoaquisicao_desc}}</td>
                                                                    <td>{{$m->cor}}</td>
                                                                    <td>{{$m->departamentos}}</td>
                                                                    <td>{{$m->data_aquisicao}}</td>
                                                                    <td>{{$m->vida_util}}</td>
                                                                    <td class="status-fail">Vencido</td>
                                                                   
                                                                    
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                      
                                       
                                    </div>
                    </div>






 <script>

$(document).ready(function(){
    
});



  //validação transferir

               



 </script>
@endsection