@extends('layout.template')
@section('title', 'Utilizador')


@section('content')

<div class="card">
                                    <h3 class="card-header">Registar Utilizador</h3>

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
                                        <form  action = "{{url('user/registar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf

                                            <div class="row">
                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Nome</label>
                                                    <input id="nome" name="name" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Email</label>
                                                    <input id="email" name="email" type="email" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Senha</label>
                                                    <input id="senha" name="password" type="password" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Confirmar Senha</label>
                                                    <input id="confirmarsenha" name="password_confirmation" type="password" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 margin-input">
                                                    <label for="perfil">Perfil</label>
                                                   <select name="perfil" id="perfil" class="form-control form-control-sm">
                                                       <option value="Selecione">Selecione</option>
                                                       @if(isset($perfil))
                                                       
                                                           @foreach($perfil as $p)
                                                           <option value="{{$p->name}}">{{$p->name}}</option>
                                                           @endforeach
                                                   
                                                        @endif
                                                   
                                                   </select>
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
            var email=document.getElementById("email");
            var senha=document.getElementById("senha");
            var confsenha=document.getElementById("confirmarsenha");
            var perfil=document.getElementById("perfil");
            var erro= document.getElementById("erro-registar");

       

            if(nome.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Nome";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(email.value == ''){
             
                erro.innerHTML="Por favor preencha o campo Email";
                erro.removeAttribute('hidden');
                email.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(senha.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Senha";
                erro.removeAttribute('hidden');
                senha.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(confsenha.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Confirmar Seanha";
                erro.removeAttribute('hidden');
                confsenha.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(perfil.value == 'Selecione'){
                
                erro.innerHTML="Por favor Selecione o perfil do utilizador";
                erro.removeAttribute('hidden');
                perfil.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(confirmarSenha(senha.value,confsenha.value))
            {
                formregistar.submit();
            }else{
                erro.innerHTML="As senhas digitadas não são iguais";
                erro.removeAttribute('hidden');
            }

            
                
            

          //  
    });

     });
</script>
@endsection