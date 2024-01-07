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
                                                                    <th>Data aquisição</th>
                                                                    <th>Vida útil</th>
                                                                    <th>Estado</th>
                                                                    
                                                                    
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
                                                                    <td>{{$v->dataAquisicao}}</td>
                                                                    <td>{{$v->vida_util}}</td>
                                                                    <td class="status-fail">Vencido</td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                      
                                       
                                    </div>


                                        
                                         
 <!-- ModalTransferir -->
 <div class="modal fade" id="ModalTransferir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transferir Veículo</h5>
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

                        <label for="input-select">Departamento Beneficiário</label>
                        <select id="departamento" class="form-control" name="departamento" id="input-select">
                            <option value="Selecione">Selecione</option>
                            @if(isset($dep))
                           
                            @foreach($dep as $d)
                            <option value="{{$d->id}}">{{$d->descricao}}</option>
                            @endforeach
                    
                         @endif
                        </select>
                   </div>

                <div class="text-right">
                    <input type="hidden" name="id_veiculo" id="id_veiculo">
                    <button class="btn btn-success" id="btn-transferir">Transferir</button>
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
                        var departamento=document.getElementById("departamento");
                        var erro_transferir= document.getElementById("erro-transferir");

                        if(departamento.value == 'Selecione'){
                            erro_transferir.innerHTML="Por favor Selecione um Departamento";
                            erro_transferir.removeAttribute('hidden');
                            departamento.focus();
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