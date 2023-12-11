@extends('layout.template')
@section('title', 'Abate veículos')


@section('content')
<form action="{{url('abate/veiculos/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
       
            
           <select name="selectbusca" id="selectbusca" class="form-control form-control-sm">
               <option value="Selecione">Pesquisar Por</option>
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
                                                                    <th>Marca</th>
                                                                    <th>Modelo</th>
                                                                    <th>Matrícula</th>
                                                                    <th>Nº Motor</th>
                                                                    <th>Cor</th>
                                                                    <th>Departamento</th>
                                                                    <th>Estado</th>
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
                                                                    @if($v->estado=='ativo')
                                                                    <td class="status-success">{{$v->estado}}</td>
                                                                    @else
                                                                    <td class="status-fail">{{$v->estado}}</td>

                                                                    @endif
                                                                    
                                                                    <td class="d-flex justify-content-center">
                                                                        
                                                                        <!--  <a href="#" class="btn btn-sm  active"><i class="m-r-10 mdi mdi-delete"></i></a>
                                                                         <a href="#" class="btn btn-sm  active"><i class="fas fa-eye"></i></a>-->
                                                                         <a href="{{url("veiculo/comprovativo/$v->id")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a> 
                                                                        @if($v->estado=='ativo')
                                                                        <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$v->id}})">abater</a>
                                                                

                                                                        @endif
                                                                         
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                       
                                                    </div> <br>
                                                  

                                                    @if(isset($ve))

                                                    <div class="container">

                                                        <div class="d-flex justify-content-center">
                                                         {{$ve->links()}}
                                                        </div>
                                                         
                                                     </div>
                                                        
                                                    @endif
                                                    
                                                   
                                                    
                                      
                                       
                                    </div>


                                         <!-- Modal -->
                                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Registar Abate</h5>
                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger" id="erro-registar" hidden>
                                                        </div>
                                                        <form action="{{url('abate/veiculos/registar')}}" method="POST" id="form-registar">
                                                            @csrf
                                                            

                                                            <div class="form-group col-lg-12 col-md-12 margin-input">
                                                               
                                                                <label for="inputText4">Motivos de Abates</label>
                                                               <select id="abate"   name="abate" class="form-control form-control-sm">
                                                                   <option value="Selecione">Selecione</option>
                                                                
                                                                       @foreach($abates as $a)
                                                                       <option value="{{$a->id}}">{{$a->descricao}}</option>
                                                                       @endforeach
                                                               </select>
                                                               <input type="hidden"  name="id_veiculo" id="id_veiculo">
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
                          $('#id_veiculo').val(id);
                           //var id_veiculo=document.getElementById("id_veiculo");
                           //id_veiculo.value=id;

                        }


                $(document).ready(function(){
                btn_registar=document.getElementById("btn-registar");
                btn_registar.addEventListener('click', (event)=>{

                        event.preventDefault();

                        var formregistar=document.getElementById("form-registar");
                        var motivo_abate=document.getElementById("abate");
                        var erro= document.getElementById("erro-registar");

                        if(motivo_abate.value == 'Selecione'){
                            erro.innerHTML="Por favor Seleciona um Motivo de abate";
                            erro.removeAttribute('hidden');
                            motivo_abate.focus();
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