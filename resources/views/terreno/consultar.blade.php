@extends('layout.template')
@section('title', 'Terrenos')


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
                                    <h3 class="card-header">Listar Terrenos</h3>

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
                                                                    <th>Descrição</th>
                                                                    <th>Nº Imobilizado</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Dimensão</th>
                                                                    <th>Data aquisição</th>
                                                                    <th>Finalidade</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($te))
                                                                    @foreach($te as $e)
                                                                <tr>
                                                                    <td>{{$e->codigo}}</td>
                                                                    <td>{{$e->num_imobilizado}}</td>
                                                                    <td>{{$e->descricao}}</td>
                                                                   
                                                                    <td>{{number_format($e->valor_aquisicao, 2,",",".")}}</td>
                                                                    <td>{{$e->dimensao}}</td>
                                                                    <td>{{$e->data_aquisicao}}</td>
                                                                    <td>{{$e->finalidade}}</td>
                                                                    <td>
                                                                         <a href="{{url("imoveis/terreno/editar/$e->codigo")}}" class="btn btn-sm  active"><i class="fas fa-edit"></i></a>
                                                                       
                                                                         <a href="{{url("terreno/comprovativo/$e->codigo")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a> 
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                      
                                       
                                    </div>
                    </div>




@endsection