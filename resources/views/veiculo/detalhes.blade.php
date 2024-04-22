@extends('layout.template')
@section('title', 'Material Escritório')


@section('content')

                    <div class="card">
                                    <h3 class="card-header">Histórico de atribuições</h3>
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
                                                                
                                                                    <th>Nome</th>
                                                                    <th>Departamento</th>
                                                                    <th>Função</th>
                                                                    <th>Data atribuição</th>
                                                                    
                                                                    
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($mat))
                                                                    @foreach($mat as $m)
                                                                <tr>
                                                                   
                                                                    <td>{{$m->pessoal}}</td>
                                                                    <td>{{$m->departamento}}</td>
                                                                    <td>{{$m->funcao}}</td>

                                                                    @php
                                                                        //formatar a data
                                                                        $dataFormatada = date('d/m/Y', strtotime($m->dataregisto));
                                                                    @endphp
                                                                    <td>{{$dataFormatada}}</td>
                                                                    
                                                                    
                                                                   
                                                                   
                                                                    
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