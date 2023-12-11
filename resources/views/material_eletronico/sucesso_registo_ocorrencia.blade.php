@extends('layout.template')
@section('title', 'MaterialElectronico')


@section('content')
<div class="input-group rounded">
    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
    <button type="button" class="btn btn-primary">
        <i class="fas fa-search"></i>
      </button>
</div>
                    <div class="card">
                        <h3 class="card-header">Listar Material Electronico</h3>
                       

                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nº Mobilizado</th>
                                                        <th>Tipo</th>
                                                        <th>Valor aquisição</th>
                                                        <th>Marca</th>
                                                        <th>Data Aquisição</th>
                                                        <th>Cor</th>
                                                        <th>Departamento</th>
                                                        <th>Acções</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($mat))
                                                        @foreach($mat as $m)
                                                    <tr>
                                                        <td>{{$m->id}}</td>
                                                        <td>{{$m->num_mobilizado}}</td>
                                                        <td>{{$m->tipo}}</td>
                                                        <td>{{$m->valor_aquisicao}}</td>
                                                        <td>{{$m->tipoaquisicao_desc}}</td>
                                                        <td>{{$m->data_aquisicao}}</td>
                                                        <td>{{$m->cor}}</td>
                                                        <td>{{$m->departamentos}}</td>
                                                       
                                                        <td class="d-flex justify-content-center">
                                                             <a href="{{url("material-electronico/editar/$m->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                             <a href="#" class="btn btn-sm  active"><i class="fas fa-file"></i></a> 
                                                             <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$m->id}})">Registar Ocorrencia</a>
                                                             <a href="{{url("historico-ocorrencia-materia/listar/$m->id")}}" class="btn btn-sm  active">Listar Ocorrencia</a>
                                                          
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
                <form action="{{route('ocorrencia-eletronico.registar')}}" method="POST" id="form-registar">
                    @csrf
                    <div class="form-group col-lg-12">
                        <label for="descricao" class="col-form-label">Descrição do problema</label>
                        <input id="descricao" name="descricao" id="descricao" type="text" class="form-control" placeholder="">
                        <input  name="material_id" id="material_id" type="hidden" class="form-control">
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
                    $('#material_id').val(id);
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