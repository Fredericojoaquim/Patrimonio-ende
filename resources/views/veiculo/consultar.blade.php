@extends('layout.template')
@section('title', 'Veículos')


@section('content')
<form action="{{url('veiculo/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
       
            
           <select name="selectbusca" id="selectbusca" class="form-control form-control-sm">
               <option value="Selecione">Selecione</option>
               <option value="Matricula">Matricula</option>
               <option value="Marca">Marca</option>
           </select> <br>
       
        <input type="search" name="descricao"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>
                    <div class="card">
                                    <h3 class="card-header">Listar Veículos</h3>

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                
                                                @if (@isset($sms))

                                                <div class="alert alert-success" role="alert">
                                                    <p>{{$sms}}</p>
                                                </div>
         
                                                @endif
                                                   
                                                
                                                
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
                                                                    <th>Departamento</th>
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
                                                                    <td>{{$v->departamentos}}</td>
                                                                    <td class="d-flex justify-content-center">
                                                                         <a href="{{url("veiculo/editar/$v->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                        <!--  <a href="#" class="btn btn-sm  active"><i class="m-r-10 mdi mdi-delete"></i></a>
                                                                         <a href="#" class="btn btn-sm  active"><i class="fas fa-eye"></i></a>-->
                                                                         <a href="{{url("veiculo/comprovativo/$v->id")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a> 
                                                                         <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$v->id}})">Registar Ocorrencia</a>
                                                                         <a href="{{url("historico-ocorrencia-veiculo/$v->id")}}" class="btn btn-sm  active">Listar Ocorrencia</a>
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
                                                        <div class="alert alert-danger" id="erro-registar" hidden>
                                                        </div>
                                                        <form action="{{url('veiculo-ocorrencia/registar')}}" method="POST" id="form-registar">
                                                            @csrf
                                                            <div class="form-group col-lg-12">
                                                                <label for="descricao" class="col-form-label">Descrição do problema</label>
                                                                <input id="descricao" name="descricao" id="descricao" type="text" class="form-control" placeholder="">
                                                                <input  name="veiculo_id" id="veiculo_id" type="hidden" class="form-control">
                                                            </div>

                                                        <div class="text-right">
                                                            <button class="btn btn-success" id="btn-registar">Registar</button>
                                                            
                                                            <button class="btn btn-danger" type="reset" ><a href="#" class="closebutton" data-dismiss="modal" aria-label="Close">Cancelar</a></button>
                                                        </div>


                                                        </form>
                                                       
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                         <!-- EndModal -->

                                         
                                         

                    </div>


 <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>       
        <script>
                        
                         function retornaid(id){
                           // alert(id);
                            
                           $('#veiculo_id').val(id);
                        }


                $(document).ready(function(){
                btn_registar=document.getElementById("btn-registar");
                btn_registar.addEventListener('click', (event)=>{

                        event.preventDefault();

                        var formregistar=document.getElementById("form-registar");
                        var descricao=document.getElementById("descricao");
                        var erro= document.getElementById("erro-registar");

                        if(descricao.value == ''){
                            erro.innerHTML="Por favor preencha o campo descrição";
                            erro.removeAttribute('hidden');
                            descricao.focus();
                            return false;
                        }else{
                            erro.setAttribute('hidden', true);
                            formregistar.submit();
                        }
                    //  
                });

     });

                    </script>
@endsection