@extends('layout.template')
@section('title', 'Tipo Aquisição')


@section('content')
<form action="{{url('tipoaquisicao/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="descricao"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>
                    <div class="card">
                                    <h3 class="card-header">Listar Tipo de Aquisição</h3>

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                
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
                                                   
                                                
                                                
                                                    <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Descrição</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($tipo))
                                                                    @foreach($tipo as $t)
                                                                <tr>
                                                                    <td>{{$t->id}}</td>
                                                                    <td>{{$t->descricao}}</td>
                                                                    <td>
                                                                         <a href="{{url("tipoaquisicao/editar/$t->id")}}" class="btn btn-sm  active"><i class="fas fa-edit"></i></a>
                                                                      <!--   <a href="#" class="btn btn-sm  active"><i class="m-r-10 mdi mdi-delete"></i></a> -->
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