@extends('layout.template')
@section('title', 'Edificio')


@section('content')



                    <div class="card">

                                    <h3 class="card-header">Listar Edifícios</h3>
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
                                                        <table id="datatable" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nº Imobilizado</th>
                                                                    <th>Descrição</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Tipo aquisição</th>
                                                                    <th>Data aquisição</th>
                                                                    <th>Nº Andar</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($edificio))
                                                                    @foreach($edificio as $e)
                                                                <tr>
                                                                    <td>{{$e->codigo}}</td>
                                                                    <td>{{$e->num_imobilizado}}</td>
                                                                    <td>{{$e->descricao}}</td>
                                                                    <td>{{number_format($e->valor_aquisicao, 2,",",".")}}</td>
                                                                    <td>{{$e->desctipo}}</td>
                                                                    <td>{{$e->data_aquisicao}}</td>
                                                                    <td>{{$e->num_andar}}</td>
                                                                    <td class="d-flex justify-content-center">
                                                                         <a href="{{url("imoveis/edificio/editar/$e->codigo")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         <a href="{{url("imoveis/edificio/comprovativo/$e->codigo")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a>
                                                                         <a class="btn btn-sm  active" href="{{url("edificio/historico-depreciacao/$e->codigo")}}">Histórico <br> Depreciações</a> 
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                      
                                       
                                    </div>
                    </div>

<script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>       
<script>
                                
        $(document).ready(function(){
                                        
            //codigo para inicializar a data table
        var table=$('#datatable').DataTable(); 
        });
</script> 
@endsection