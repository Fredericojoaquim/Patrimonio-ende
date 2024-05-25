@extends('layout.template')
@section('title', 'Informação de Abate')


@section('content')

                    <div class="card">
                                    <h3 class="card-header">Detalhes de Abate</h3>
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
                                                                  
                                                                    <th>Id</th>
                                                                    <th>Motivo de Abate</th>
                                                                    <th>Data Abate</th>
                                                                    
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($dados))
                                                                    @foreach($dados as $dado)
                                                                <tr>
                                                                    <td>{{$dado->id}}</td>
                                                                    <td>{{$dado-> motivoAbate}}</td>
                                                                    <td>{{$dado->dataAbate}}</td>
                                                                   
                                                                    
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

 
  


 <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>       
 <script>

     ;
                 
                  function retornaid(id){
                    // alert(id);
                    $('#terreno_id').val(id);
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