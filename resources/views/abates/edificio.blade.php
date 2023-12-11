@extends('layout.template')
@section('title', 'Material Escritorio')


@section('content')
<div class="input-group rounded">
    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
    <button type="button" class="btn btn-primary">
        <i class="fas fa-search"></i>
      </button>
</div>
                    <div class="card">
                                    <h3 class="card-header">Listar Edifícios</h3>
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
                                                                    <th>Nº Imobilizado</th>
                                                                    <th>Descrição</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Tipo aquisição</th>
                                                                    <th>Data aquisição</th>
                                                                    <th>Nº Andar</th>
                                                                    <th>Estado</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($edificio))
                                                                @foreach($edificio as $e)
                                                                <tr>
                                                                    <td>{{$e->codigo}}</td>
                                                                    <td>{{$e->num_imobilizado}}</td>
                                                                    <td>{{$e->descricao}}</td>
                                                                    <td>{{$e->valor_aquisicao}}</td>
                                                                    <td>{{$e->desctipo}}</td>
                                                                    <td>{{$e->data_aquisicao}}</td>
                                                                    <td>{{$e->num_andar}}</td>
                                                                    
                                                                    
                                                                    @if($e->estado=='ativo')

                                                                    <td class="status-success">{{$e->estado}}</td>
                                                                    @else
                                                                    <td class="status-fail">{{$e->estado}}</td>

                                                                    @endif
                                                                   
                                                                    <td class="d-flex justify-content-center">
                                                                        
                                                                         <a href="{{url("#")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a>
                                                                   @if($e->estado=='ativo')
                                                                         <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$e->codigo}})">abater</a>
                                                                   @endif 
                                                                         
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div><br><br>
                                    </div>

                                    @if(isset($mat))
                                    <div class="container">

                                        <div class="">
                                         {{$mat->links()}}
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
                <form action="{{url('abate/edificio/registar')}}" method="POST" id="form-registar">
                    @csrf
                    

                    <div class="form-group col-lg-12 col-md-12 margin-input">
                       
                        <label for="abate">Motivos de Abates</label>
                       <select id="abate"   name="abate" class="form-control form-control-sm">
                           <option value="Selecione">Selecione</option>
                        
                               @foreach($abates as $a)
                               <option value="{{$a->id}}">{{$a->descricao}}</option>
                               @endforeach
                       </select>
                       <input type="hidden"  name="edificio_id" id="edificio_id">
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

 <!-- EndModal -->


 <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>       
 <script>
                 
                  function retornaid(id){
                    // alert(id);
                    $('#edificio_id').val(id);
                 }


         $(document).ready(function(){
         btn_registar=document.getElementById("btn-registar");
         btn_registar.addEventListener('click', (event)=>{

                 event.preventDefault();

                 var formregistar=document.getElementById("form-registar");
                 var motivo=document.getElementById("abate");
                 var erro= document.getElementById("erro-registar");

                 if(motivo.value == 'Selecione'){
                     erro.innerHTML="Por favor Selecione um motivo deabate";
                     erro.removeAttribute('hidden');
                     motivo.focus();
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