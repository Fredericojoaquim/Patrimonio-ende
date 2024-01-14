@extends('layout.template')
@section('title', 'pre-definições')


@section('content')

<div class="card">

<div class="card-body">
    <div class="user-avatar text-center d-block">
       
       
        @if(empty($def->img))
        <img src="{{asset('img/images.jpg')}}" alt="User Avatar" class="rounded-circle user-avatar-xxl"> <br>
        @else
        @if(isset($file))
        <img src="{{asset('img/'.$def->img)}}" alt="User Avatar" class="rounded-circle user-avatar-xxl"> <br>
        @else
        <img src="{{asset('img/'.$def->img)}}" alt="User Avatar" class="rounded-circle user-avatar-xxl"> <br>
        @endif
       
        @endif
        <br>
        @if (@isset($sms))

        <div class="alert alert-success" role="alert">
            <p>{{$sms}}</p>
        </div>

        @endif

        <button class="my_link"  data-toggle="modal" data-target="#exampleModal">Alterar foto</button>
    </div>
   
</div>
<div class="card-body border-top">
    <h3 class="font-16">Informações do sistema</h3>
    <a class="my_link"  href="{{url('user/perfil/minhaConta')}}">Alterar dados do sistema</a> <br> <br>
    <div class="">
        <ul class="list-unstyled mb-0">
        <li class="mb-2">Nome sistema: {{$def->nomesistema}}</li>
        <li class="mb-0">Descrição da barra inferior:  {{$def->barra_inferior}}</li>
    </ul>
    </div>
</div>



</div>





 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Foto</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="erro-registar" hidden>
                </div>
                <form action="{{url('user/perfil/alterar-foto')}}" method="POST" id="form-registar" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" name="imagem" type="file" id="file">
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                    </div>

                <div class="text-right">
                    <button class="btn btn-success" id="btn-registar">Alterar</button>
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
    btn_registar=document.getElementById("btn-registar");

    btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();
            

            var file=document.getElementById("file");
            var erro= document.getElementById("erro-registar");
            var formregistar=document.getElementById("form-registar");

            if(file.value == ''){
                
                erro.innerHTML="Por favor selecione uma foto";
                erro.removeAttribute('hidden');
                
                return false;
            }else{
                erro.setAttribute('hidden', true);
                formregistar.submit();
            }
    });
});


 </script>

@endsection