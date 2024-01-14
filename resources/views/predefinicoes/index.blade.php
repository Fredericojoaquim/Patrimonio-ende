@extends('layout.template')
@section('title', 'Predefinicoes')


@section('content')

<div class="card">
                                    <h3 class="card-header">Pre-definições</h3>

                                    <div class="card-body">
                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                        @endif
                                        @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                        @endif
                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>
                                        <form  action = "{{url('pre-definicoe/registar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf

                                            <div class="row">
                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="nome" class="col-form-label">Nome sistema</label>
                                                    <input id="nome" name="nome" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="barra" class="col-form-label">descrição Barra inferior</label>
                                                    <input id="barra" name="barra" type="email" class="form-control">
                                                </div>

                                                

                                               <div class="form-group col-lg-12 col-md-12">
                                                    <label for="logo" class="col-form-label">Logotipo</label>
                                                    <input id="logo" name="logo" type="file" class="form-control">
                                               </div>


                                 
                                            </div>     
                                            <div class="text-right">
                                                <button class="btn btn-success" id="btn-registar" type="submit">Registar</button>
                                                <button class="btn btn-danger" type="reset">Cancelar</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                     </div>
<script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 
<script>
function confirmarSenha(a,b) 
{
  return a==b;
}


$(document).ready(function(){
    btn_registar=document.getElementById("btn-registar");
    btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();

            var formregistar=document.getElementById("form-registar");
            var nome=document.getElementById("nome");
            var email=document.getElementById("barra");
            var senha=document.getElementById("logo");
           
            var erro= document.getElementById("erro-registar");

       

            if(nome.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Nome sistema";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(barra.value == ''){
             
                erro.innerHTML="Por favor preencha descrição de barra inferior";
                erro.removeAttribute('hidden');
                barra.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(logo.value == ''){
                
                erro.innerHTML="Por favor selecione uma imagem como logotipo do sistema";
                erro.removeAttribute('hidden');
                logo.focus();
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