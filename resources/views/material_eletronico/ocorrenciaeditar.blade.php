
@extends('layout.template')
@section('title', 'Historico Ocorrencias')


@section('content')
<div class="card">
    <h3 class="card-header">Ocorrencias</h3>

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
                                    <td>{{$o->material_id}}</td>
                                    <td>{{$o->descricao_problema}}</td>
                                    <td>{{$o->estado}}</td>
                                    <td>{{$o->data_ocorrencia}}</td>
                                    <td class="d-flex justify-content-center">
                                        @if($o->estado=='Pendente')
                                        <a href="{{url("historico-ocorrencia-materia/editar/$o->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
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
                <form action="{{url('historico-ocorrencia-materia/update')}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    @if(isset($oc))
                    <div class="form-group col-lg-12">
                        <label for="descricao" class="col-form-label">Descrição do problema</label>
                        <input  value="{{$oc->descricao_problema}}"  name="descricao" id="descricao" type="text" class="form-control" placeholder="">
                        <input  name="ocorrencia_id"  value="{{$oc->id}}" id="ocorrencia_id" type="hidden" class="form-control">
                    </div>
                    @endif

                <div class="text-right">
                    <button class="btn btn-success ">Registar</button>
                    
                    <button class="btn btn-danger" type="reset" ><a href="#" class="closebutton" data-dismiss="modal" aria-label="Close">Cancelar</a></button>
                </div>


                </form>
               
            </div>
           
        </div>
    </div>
</div>
 <!-- EndModal -->


 <script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 
<script>


$(document).ready(function(){
   
    $('#ModalOcorrencia').modal('show');

   /* btn_registar=document.getElementById("btn-registar");
    btn_registar.addEventListener('click', (event)=>{

    });*/
});

</script> 

@endsection