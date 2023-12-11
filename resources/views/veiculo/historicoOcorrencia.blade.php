
@extends('layout.template')
@section('title', 'Historico Ocorrencias')


@section('content')

<form action="{{url('')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="descricao"  class="form-control rounded" placeholder="Descrição do problema" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>


<div class="card">
   
    <h3 class="card-header">Ocorrencias</h3>
    @if (@isset($sms))

    <div class="alert alert-success" role="alert">
            <p>{{$sms}}</p>
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
                                    <th>Id Veiculo</th>
                                    <th>Descrição do problema</th>
                                    <th>Estado</th>
                                    <th>Data de Ocorrencia</th>
                                    <th>Acções</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($ocorrencias))
                                    @foreach($ocorrencias as $o)
                                <tr>
                                    <td>{{$o->id}}</td>
                                    <td>{{$o->veiculo_id}}</td>
                                    <td>{{$o->descricao_problema}}</td>
                                    <td>{{$o->estado}}</td>
                                    <td>{{$o->data_ocorrencia}}</td>
                                    <td class="d-flex justify-content-center">
                                        @if($o->estado=='Pendente')
                                          <a href="{{url("historico-ocorrencia-veiculo/editar/$o->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                            
                                        @endif
                                       
                                    </td>
                                </tr>
                                @endforeach
                            @endif  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


@endsection