@extends('layout.template')
@section('title', 'Utilizador')


@section('content')

<div class="card">
                                    <h3 class="card-header">Alterar meus dados</h3>

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
                                        <form  action = "{{url('user/perfil/update')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf
                                        {{ method_field('PUT') }}

                                            @if(isset($user))

                                            <div class="row">
                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Nome</label>
                                                    <input id="nome" value="{{$user->name}}" name="name" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12">
                                                    <label for="inputText3" class="col-form-label">Telefone</label>
                                                    <input id="telefone" value="{{$user->email}}" name="telefone" type="email" class="form-control">
                                                </div>

                                               
                                                <div class="form-group col-lg-12 my_margin text-center">
                                                    <strong><p class="text-center">Alterar a senha?</p></strong>
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="nao_seguros" onclick="habilitasenha()"   name="check_password"  class="custom-control-input" value="sim"><span class="custom-control-label">SIM</span>
                                                    </label>
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio"  id="nao_seguro" onclick="habilitasenha()" checked=""  name="check_password" class="custom-control-input" value="não"><span class="custom-control-label">NÃO</span>
                                                    </label>
                                                </div>
                                            </div>  

                                                <div class="row" id="div_senha" hidden>
                                                    
                                                    <div class="form-group col-lg-6 col-md-12 margin-input">
                                                        <label for="inputText4">Senha</label>
                                                        <input id="senha" name="password" type="password" placeholder="" class="form-control"> 
                                                    </div>
    
                                                    <div class="form-group col-lg-6 col-md-12 margin-input">
                                                        <label for="inputText4">Confirmar Senha</label>
                                                        <input id="confirmarsenha" name="password_confirmation" type="password" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                                
                                            @endif

                                               
                                 
                                              
                                            <div class="text-right">
                                                <button class="btn btn-success" id="btn-registar" type="submit">Registar</button>
                                                <button class="btn btn-danger" type="reset">Cancelar</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                     </div>
<script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 
<script>

function habilitasenha()
{
   // var nao=document.getElementById("nao_seguro");
   
    var check=document.querySelector('input[name="check_password"]:checked').value;
    var div_senha=document.getElementById("div_senha");
     if(check=='sim')
     {
        div_senha.removeAttribute('hidden');

     }else{
        div_senha.setAttribute('hidden', true);
     }
}
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
            var telefone=document.getElementById("telefone");
            var senha=document.getElementById("senha");
            var confsenha=document.getElementById("confirmarsenha");
            var check=document.querySelector('input[name="check_password"]:checked').value;
           alert(check);
            var erro= document.getElementById("erro-registar");

       

            if(nome.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Nome";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(telefone.value == ''){
             
                erro.innerHTML="Por favor preencha o campo telefone";
                erro.removeAttribute('hidden');
                telefone.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(check=='sim'){

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


                    if(confirmarSenha(senha.value,confsenha.value))
                    {
                        formregistar.submit();
                    }else{
                        erro.innerHTML="As senhas digitadas não são iguais";
                        erro.removeAttribute('hidden');
                    }

            }else{
                erro.removeAttribute('hidden');
                formregistar.submit();
            }

           

            
                
            

          //  
    });

     });
</script>
@endsection