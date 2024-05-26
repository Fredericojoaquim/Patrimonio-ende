@extends('layout.template')
@section('title', 'Veículos')


@section('content')
<div class="input-group rounded">
    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
    <button type="button" class="btn btn-primary">
        <i class="fas fa-search"></i>
      </button>
</div>
                    <div class="card">
                                    <h3 class="card-header">Listar Veículos</h3>

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                
                                                 
                                                   
                                                
                                                
                                                    <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Marca</th>
                                                                    <th>Modelo</th>
                                                                    <th>Matrícula</th>
                                                                    <th>Nº Motor</th>
                                                                    <th>Cor</th>
                                                                    <th>Atribuido ao</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($ve))
                                                                    @foreach($ve as $v)
                                                                <tr>
                                                                    <td>{{$v->id}}</td>
                                                                    <td>{{$v->marca}}</td>
                                                                    <td>{{$v->modelo}}</td>
                                                                    <td>{{$v->matricula}}</td>
                                                                    <td>{{$v->num_motor}}</td>
                                                                    <td>{{$v->cor}}</td>
                                                                    <td>{{$v->pessoal}}</td>
                                                                    <td class="d-flex justify-content-center">
                                                                         <a href="#" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         <a href="#" class="btn btn-sm  active"><i class="m-r-10 mdi mdi-delete"></i></a>
                                                                         <!-- <a href="#" class="btn btn-sm  active"><i class="fas fa-eye"></i></a>
                                                                         <a href="#" class="btn btn-sm  active"><i class="fas fa-file"></i></a> -->
                                                                         <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$v->id}})">Ocorrencia</a>
                                                                         <a href="{{url("historico-ocorrencia-veiculo/$v->id")}}" class="btn btn-sm  active">Histórico Ocorrencia</a>
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                      
                                       
                                    </div>


                                         <!-- Modal -->
                                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Registar Ocorrencia</h5>
                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{url('veiculo-ocorrencia/registar')}}" method="POST">
                                                            @csrf
                                                            <div class="form-group col-lg-12">
                                                                <label for="inputText7" class="col-form-label">Descrição do problema</label>
                                                                <input id="inputText7" name="descricao" id="descricao" type="text" class="form-control" placeholder="">
                                                                <input  name="veiculo_id" id="veiculo_id" type="hidden" class="form-control">
                                                            </div>

                                                        <div class="text-right">
                                                            <button class="btn btn-success ">Registar</button>
                                                            
                                                            <button class="btn btn-danger" ><a href="#" class="closebutton" data-dismiss="modal" aria-label="Close">Cancelar</a></button>
                                                        </div>


                                                        </form>
                                                       
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                         <!-- EndModal -->

                                         
                                        <!-- Modal -->
                                        <div class="modal fade" id="ModalMensagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Registar Ocorrencia</h5>
                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="alert alert-success" role="alert">
                                                            <p>{{$sms}}</p>
                                                        </div>
                                              
                                                       
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                         <!-- EndModal -->
                    </div>

                    <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
                    <script>
                         $(document).ready(function(){
                        //codigo para inicializar a data table
                        $('#ModalMensagem').modal('show');
                        });



                         function retornaid(id){
                           // alert(id);
                            $('#veiculo_id').val(id);
                        }

                       

                    </script>
@endsection