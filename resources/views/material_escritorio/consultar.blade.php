@extends('layout.template')
@section('title', 'Material Escritório')


@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>

    /* Estilo para o campo de pesquisa */
.dataTables_filter label {
    display: flex;
    align-items: center;
}

.dataTables_filter input[type="search"] {
    width: calc(100% - 30px); /* Definindo o tamanho do campo de pesquisa */
    padding: .375rem .75rem .375rem 30px; /* Adicionando espaço para o ícone */
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    position: relative; /* Posicionamento relativo para o ícone */
}

/* Estilo para o ícone de lupa */
.dataTables_filter input[type="search"]::before {
    content: "\f002"; /* Código do ícone de lupa do FontAwesome */
    font-family: "Font Awesome 5 Free"; /* Fonte do FontAwesome */
    position: absolute;
    left: 10px; /* Posição do ícone */
    top: 50%;
    transform: translateY(-50%);
    color: #dd1717; /* Cor do ícone */
}

/* Estilo para o botão de pesquisa */
.dataTables_filter input[type="search"]:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
}



</style>
<!--
<form action="{{url('material-escritorio/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="num_imobilizado"  class="form-control rounded" placeholder="Nº Imobilizado" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form> -->    
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
                                                        <table id="datatable" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nº Mobilizado</th>
                                                                    <th>Tipo</th>
                                                                    <th>Valor aquisição</th>
                                                                    <th>Tipo Aquisição</th>
                                                                    <th>Data Aquisição</th>
                                                                    <th>Cor</th>
                                                                    <th>Atribuído ao</th>
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
                                                                    <td>{{$m->pessoal}}</td>
                                                                   
                                                                    <td class="d-flex justify-content-center">
                                                                         <a href="{{url("material-escritorio/editar/$m->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         <a href="{{URL("material-escritorio/comprovativo/$m->id")}}" target="_blank" class="btn btn-sm  active"><i class="fas fa-file"></i></a>
                                                                         <a class="btn btn-sm  active" data-toggle="modal" data-target="#ModalTransferir" href="#" onclick="retornaidTranferir({{$m->id}})">Atribuir</a>
                                                                         <a class="btn btn-sm  active" href="{{url("material-escritorio/historico/$m->id")}}">Histórico <br> Atribuições</a>
                                                                      
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
                <h5 class="modal-title" id="exampleModalLabel">Atribuir Móvel</h5>
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

                        <label for="input-select">Atribuir para</label>
                        <select id="departamento" class="form-control" name="pessoal_id" id="input-select">
                            <option value="Selecione">Selecione</option>
                            @if(isset($pessoal))
                           
                            @foreach($pessoal as $p)
                            <option value="{{$p->id}}">{{$p->nome}}</option>
                            @endforeach
                    
                         @endif
                        </select>
                   </div>

                <div class="text-right">
                    <input type="hidden" name="material_id" id="material_id">
                    <button class="btn btn-success" id="btn-transferir">Atribuir</button>
                    
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
 $(document).ready(function(){

     //codigo para inicializar a data table
     // var table=$('#datatable').DataTable(); 
 });
 
function retornaidTranferir(id){
    
    $('#material_id').val(id);
 }


 $(document).ready(function() {
   

    

   // var table=$('#datatable').DataTable(); 
     // Adicione classes do Bootstrap ao campo de pesquisa
    


     //
     $(document).ready(function() {

    $('#datatable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        }
    });

    // Verifique se a DataTable já foi inicializada antes de recriá-la
    if ($.fn.DataTable.isDataTable('#datatable')) {
        // Destrua a DataTable existente antes de recriá-la
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        }
    });
    var table=$('#datatable').DataTable();
   // Adicione classes do Bootstrap aos botões de paginação após a DataTable ser inicializada
   $('#datatable_paginate .paginate_button').addClass('btn btn-outline-primary');

// Personalize os ícones dos botões de paginação
$('#datatable_previous').html('<i class="fas fa-chevron-left"></i> Anterior');
$('#datatable_next').html('Próximo <i class="fas fa-chevron-right"></i>');

   


    
   
});

    

});


  //validação transferir

                btn_transferir=document.getElementById("btn-transferir");
                btn_transferir.addEventListener('click', (event)=>{

                        event.preventDefault();

                        var form_transferir=document.getElementById("form-transferir");
                        var departamento=document.getElementById("departamento");
                        var erro_transferir= document.getElementById("erro-transferir");

                        if(departamento.value == 'Selecione'){
                            erro_transferir.innerHTML="Por favor Selecione um colaborador";
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