@extends('layout.template')
@section('title', 'Material Escritorio')


@section('content')

                    <div class="card">
                                    <h3 class="card-header">Listar Material Electronico</h3>
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
                                                                    <th>Nº Mobilizado</th>
                                                                    <th>Tipo</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Marca</th>
                                                                    <th>Data Aquisição</th>
                                                                    <th>Cor</th>
                                                                    <th>Atribuído ao</th>  
                                                                    <th>Estado</th>
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
                                                                    <td>{{$m->marca}}</td>
                                                                    <td>{{$m->data_aquisicao}}</td>
                                                                    <td>{{$m->cor}}</td>
                                                                    <td>{{$m->pessoal}}</td>
                                                                    
                                                                    @if($m->estado=='ativo')
                                                                    <td class="status-success">{{$m->estado}}</td>
                                                                    @else
                                                                    <td class="status-fail">{{$m->estado}}</td>

                                                                    @endif
                                                                   
                                                                    <td class="d-flex justify-content-center">
                                                                        
                                                                         <a href="{{url("material-electronico/comprovativo/$m->id")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a>
                                                                         @if($m->estado=='ativo')
                                                                         <a href="#" class="btn btn-sm  active" data-toggle="modal" data-target="#exampleModal" onclick="retornaid({{$m->id}})">abater</a>
                                                                         @endif 
                                                                        
                                                                        
                                                                      
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div><br><br>
                                    </div>

                                    
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
                <form action="{{url('abate/MaterialEletronico/registar')}}" method="POST" id="form-registar">
                    @csrf
                    

                    <div class="form-group col-lg-12 col-md-12 margin-input">
                       
                        <label for="abate">Motivos de Abates</label>
                       <select id="abate"   name="abate" class="form-control form-control-sm">
                           <option value="Selecione">Selecione</option>
                        
                               @foreach($abates as $a)
                               <option value="{{$a->id}}">{{$a->descricao}}</option>
                               @endforeach
                       </select>
                       <input type="hidden"  name="id_material" id="id_material">
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

$(document).ready(function(){
             $('#datatable').DataTable({
            fixedHeader: true
               });

              //codigo para inicializar a data table
            var table=$('#datatable').DataTable();

s});



                 
                  function retornaid(id){
                    // alert(id);
                    $('#id_material').val(id);
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