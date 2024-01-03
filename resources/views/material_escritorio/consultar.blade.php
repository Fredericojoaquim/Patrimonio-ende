@extends('layout.template')
@section('title', 'Material Escritório')


@section('content')
<form action="{{url('material-escritorio/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="num_imobilizado"  class="form-control rounded" placeholder="Nº Imobilizado" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>
                    <div class="card">
                                    <h3 class="card-header">Listar Material Escritório</h3>
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
                                                                    <th>Nº Mobilizado</th>
                                                                    <th>Tipo</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Tipo Aquisição</th>
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
                                                                         <a href="{{url("material-escritorio/editar/$m->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         <a href="{{URL("material-escritorio/comprovativo/$m->id")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a>
                                                                         <a class="btn btn-sm  active" data-toggle="modal" data-target="#ModalTransferir" href="#" onclick="retornaidTranferir({{$m->id}})">Tranferir</a>
                                                                      
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                      
                                       
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
                <form action="{{url('material-escritorio/transferir')}}" method="POST" id="form-transferir">
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
                    <input type="hidden" name="material_id" id="material_id">
                    <button class="btn btn-success" id="btn-transferir">Transferir</button>
                    <button class="btn btn-danger" type="reset" ><a href="#" class="closebutton" data-dismiss="modal" aria-label="Close">Cancelar</a></button>
                </div>


                </form>
               
            </div>
           
        </div>
    </div>
</div>
 <!-- EndModal -->

 <script>

function retornaidTranferir(id){
    
    $('#material_id').val(id);
 }

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



 </script>
@endsection