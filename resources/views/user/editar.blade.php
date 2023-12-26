@extends('layout.template')
@section('title', 'Utilizador')


@section('content')

<div class="card">
                                    <h3 class="card-header">Alterar Utilizador</h3>

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
                                        <form  action = "{{url('user/editar/salvar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf
                                        {{ method_field('PUT') }}

                                            <div class="row">
                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Nome</label>
                                                    <input id="nome" name="name" value="{{$u->name}}" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12">
                                                    <label for="inputText3" class="col-form-label">Email</label>
                                                    <input id="email" name="email" value="{{$u->email}}" type="email" class="form-control">
                                                </div>

                                               

            

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
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

                                               <div class="form-group col-lg-6 col-md-12">
                                                <label for="telefone" class="col-form-label">Telefone</label>
                                                <input id="telefone" value="{{$p->telefone}}" name="telefone" type="text" class="form-control">
                                            </div>
                                 
                                            </div>     
                                            <div class="text-right">
                                                <input id="id" name="id" value="{{$u->id}}" type="hidden" class="form-control">
                                                <button class="btn btn-success" id="btn-registar" type="submit">Alterar</button>
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

           

            

            if(perfil.value == 'Selecione'){
                
                erro.innerHTML="Por favor Selecione o perfil do utilizador";
                erro.removeAttribute('hidden');
                perfil.focus();
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