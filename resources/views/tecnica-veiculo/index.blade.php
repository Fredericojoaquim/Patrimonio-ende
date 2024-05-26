
@extends('layout.template')
@section('title', 'Historico Ocorrencias')


@section('content')


<div class="card">
   
    <h3 class="card-header">Ocorrencias técnica de veículos</h3>
    @if (@isset($sms))

    <div class="alert alert-success" role="alert">
            <p>{{$sms}}</p>
    </div>

   @endif
    <div class="card-body">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered second" style="width:100%">
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

                                        <a href="{{url("tecnica/veiculo/sobre/$o->veiculo_id")}}" target="_blank" class="btn btn-sm active">Sobre o Veículo</a>
                                     
                                        
                                        @switch($o->estado)
                                            @case('Pendente')
                                            <a href="{{URL("tecnica/veiculo/diagnosticar/$o->id")}}" class="btn btn-sm active">Diagnósticar</a>
                                            @break
                                            @case('Diagnosticando')
                                            <a href="{{url("tecnica/veiculo/resolver/$o->id")}}" class="btn btn-sm active">Resolver</a>
                                            @break
                                            @case('Resolvendo')
                                            <a href="#"  data-toggle="modal" data-target="#ModalOcorrencia"  onclick="retornaid({{$o->id}})" class="btn btn-sm active">Concluir</a>
                                            @break

                                            @case('Concluído')
                                            <a href="{{url("tecnica/veiculo/informacao/$o->id")}}"   class="btn btn-sm active"> informação</a>
                                            @break
                                            @default
                                                
                                        @endswitch
                                    
                                       
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
<div class="modal fade" id="ModalOcorrencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="{{url('tecnica/veiculo/concluir')}}" method="POST" id="form-registar">
                    @csrf

                    {{ method_field('PUT') }}
              
                    <div class="form-group col-lg-12">
                        <label for="descricao" class="col-form-label">Descrição da solução</label>
                        <input  value=""  name="descricao" id="descricao" type="text" class="form-control" placeholder="">
                        <input  name="ocorrencia_id"   id="ocorrencia_id" type="hidden" class="form-control">
                    </div>
            

                <div class="text-right">
                    <button class="btn btn-success" id="btn-registar">Concluir</button>
                    <button class="btn btn-danger" type="reset" ><a href="#" class="closebutton" data-dismiss="modal" aria-label="Close">Cancelar</a></button>
                </div>


                </form>
               
            </div>
           
        </div>
    </div>
</div>
 <!-- EndModal -->

 <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
 <script>
    function retornaid(id){
        // alert(id);
         $('#ocorrencia_id').val(id);
    }

    $(document).ready(function(){
         //codigo para inicializar a data table
         var table=$('#datatable').DataTable(); 
    });

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