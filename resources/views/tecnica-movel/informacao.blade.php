
@extends('layout.template')
@section('title', 'Historico Ocorrencias')


@section('content')
<div class="card">
   
    <h3 class="card-header">Informação da Ocorrencia</h3>
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
                                    <th>Id Mat Electronico</th>
                                    <th>Descrição do problema</th>
                                    <th>Estado</th>
                                    <th>Descrição Solução</th>
                                    <th>Data de Ocorrencia</th>
                                    <th>Data conclusão</th>
                                    <th>Técnico</th>
                                  
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($o))
                                
                                  
                                <tr>
                                    <td>{{$o->id}}</td>
                                    <td>{{$o->material_id}}</td>
                                    <td>{{$o->descricao_problema}}</td>
                                    <td>{{$o->estado}}</td>
                                    <td>{{$o->descricao_solucao}}</td>
                                    <td>{{$o->data_ocorrencia}}</td>
                                    <td>{{$o->data_resolucao}}</td>
                                    <td>{{$o->tecnico}}</td> 
                                </tr>
                             
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
                <form action="{{url('tecnica/veiculo/concluir')}}" method="POST">
                    @csrf

                    {{ method_field('PUT') }}
              
                    <div class="form-group col-lg-12">
                        <label for="descricao" class="col-form-label">Descrição da solução</label>
                        <input  value=""  name="descricao" id="descricao" type="text" class="form-control" placeholder="">
                        <input  name="ocorrencia_id"   id="ocorrencia_id" type="hidden" class="form-control">
                    </div>
            

                <div class="text-right">
                    <button class="btn btn-success ">Concluir</button>
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
</script>
@endsection