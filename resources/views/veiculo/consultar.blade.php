@extends('layout.template')
@section('title', 'Veículos')


@section('content')

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
                                                        <table id="datatable" class="table table-striped table-bordered second" style="width:100%" class="display">
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
                                                                         <a href="{{url("veiculo/editar/$v->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         
                                                                        <!--  <a href="#" class="btn btn-sm  active"><i class="m-r-10 mdi mdi-delete"></i></a>
                                                                         <a href="#" class="btn btn-sm  active"><i class="fas fa-eye"></i></a>-->
                                                                         <a href="{{url("veiculo/comprovativo/$v->id")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a> 
                                                                         <a class="btn btn-sm  active" data-toggle="modal" data-target="#ModalTransferir" href="#" onclick="retornaidTranferir({{$v->id}})">Atribuir</a>
                                                                         <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$v->id}})">Registar Ocorrencia</a>
                                                                         <a class="btn btn-sm  active" href="{{url("veiculo/historico-atribuicoes/$v->id")}}">Histórico <br> Atribuições</a>
                                                                         <a href="{{url("historico-ocorrencia-veiculo/$v->id")}}" class="btn btn-sm  active">Listar Ocorrencia</a>
                                                                         <a class="btn btn-sm  active" href="{{url("veiculo/historico-depreciacao/$v->id")}}">Histórico <br> Depreciações</a>
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

                                         
                                         
 <!-- ModalTransferir -->
 <div class="modal fade" id="ModalTransferir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atribuir Veículo</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="erro-transferir" hidden>
                </div>
                <form action="{{url('veiculo/transferir')}}" method="POST" id="form-transferir">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group col-lg-12 margin-input">

                        <label for="input-select">Atribuir para</label>
                        <select id="pessoal" class="form-control" name="pessoal" id="input-select">
                            <option value="Selecione">Selecione</option>
                            @if(isset($pessoal))
                           
                            @foreach($pessoal as $p)
                            <option value="{{$p->id}}">{{$p->nome}}</option>
                            @endforeach
                    
                         @endif
                        </select>
                   </div>

                <div class="text-right">
                    <input type="hidden" name="id_veiculo" id="id_veiculo">
                    <button class="btn btn-success" id="btn-transferir">Atribuir</button>
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

$(document).ready(function(){
    $('#datatable').DataTable({
            fixedHeader: true
        });
   
//codigo para inicializar a data table
 var table=$('#datatable').DataTable(); 

});
                        
                         function retornaid(id){
                           // alert(id);
                            
                           $('#veiculo_id').val(id);
                        }

                        function retornaidTranferir(id){
                           // alert(id);
                            
                           $('#id_veiculo').val(id);
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

                //validação transferir

                btn_transferir=document.getElementById("btn-transferir");
                btn_transferir.addEventListener('click', (event)=>{

                        event.preventDefault();

                        var form_transferir=document.getElementById("form-transferir");
                        var pessoal=document.getElementById("pessoal");
                        var erro_transferir= document.getElementById("erro-transferir");

                        if(pessoal.value == 'Selecione'){
                            erro_transferir.innerHTML="Por favor Selecione uma pessoa para atribuir este veiculo";
                            erro_transferir.removeAttribute('hidden');
                            pessoal.focus();
                            return false;
                        }else{
                            erro_transferir.setAttribute('hidden', true);
                            form_transferir.submit();
                        }
                    //  
                });






     });

                    </script>
@endsection