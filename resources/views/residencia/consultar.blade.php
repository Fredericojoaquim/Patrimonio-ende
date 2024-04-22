@extends('layout.template')
@section('title', 'Residencia')


@section('content')

<form action="{{url('imoveis/terreno/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="num_mobilizado"  class="form-control rounded" placeholder="Nº imobilizado" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>

                    <div class="card">
                                    <h3 class="card-header">Listar Residencias</h3>

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
                                                                    <th>Dimensão</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Tipo aquisição</th>
                                                                    <th>Data aquisição</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($res))
                                                                    @foreach($res as $r)
                                                                <tr>
                                                                    <td>{{$r->codigo}}</td>
                                                                    <td>{{$r->num_imobilizado}}</td>
                                                                    <td>{{number_format($r->valor_aquisicao, 2,",",".")}}</td>
                                                                    <td>{{$r->descricao}}</td>
                                                                    <td>{{$r->dimensao}}</td>
                                                                   
                                                                    
                                                                    <td>{{$r->tipo_desc}}</td>
                                                                    <td>{{$r->data_aquisicao}}</td>
                                                                    <td class="d-flex justify-content-center">
                                                                         <a class="btn btn-sm  active" href="{{url("residencia/editar/$r->codigo")}}" class=""><i class="fas fa-edit"></i></a>
                                                                         <a class="btn btn-sm  active" href="{{url("imoveis/residencia/comprovativo/$r->codigo}")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a> 
                                                                         <a class="btn btn-sm  active" href="{{url("residencia/historico-depreciacao/$r->codigo")}}">Histórico <br> Depreciações</a>
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