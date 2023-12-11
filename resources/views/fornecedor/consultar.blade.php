@extends('layout.template')
@section('title', 'Departamentos')


@section('content')
<form action="{{url('tipoaquisicao/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="nome"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>
                    <div class="card">
                                    <h3 class="card-header">Listar Fornecedor</h3>

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                
                                                 
                                                   
                                                
                                                
                                                    <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nome</th>
                                                                    <th>Nif</th>
                                                                    <th>Telefone</th>
                                                                    <th>Endereço</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($for))
                                                                    @foreach($for as $f)
                                                                <tr>
                                                                    <td>{{$f->id}}</td>
                                                                    <td>{{$f->nome}}</td>
                                                                    <td>{{$f->nif}}</td>
                                                                    <td>{{$f->telefone}}</td>
                                                                    <td>{{$f->endereco}}</td>
                                                                    <td>
                                                                         <a href="{{url("fornecedor/editar/$f->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         <a href="#" class="btn btn-sm  active"><i class="m-r-10 mdi mdi-delete"></i></a>
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