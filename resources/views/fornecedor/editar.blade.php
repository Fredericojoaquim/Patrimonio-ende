@extends('layout.template')
@section('title', 'Fornecedor')


@section('content')

<div class="card">
                                    <h3 class="card-header">Registar Fornecedor</h3>

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
                                        <form  action = "{{url('fornecedor/editar/salvar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf
                                        {{ method_field('PUT') }}

                                            <div class="row">
                                                @if(isset($f))
                                                    
                                               

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Nome</label>
                                                    <input id="nome" name="nome" value="{{$f->nome}}" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">NIF</label>
                                                    <input id="nif" name="nif" value="{{$f->nif}}" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Email</label>
                                                    <input id="email" name="email" value="{{$f->email}}" type="email" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Telefone</label>
                                                    <input id="telefone" name="telefone" value="{{$f->telefone}}" type="text" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 margin-input">
                                                    <label for="inputText4">Endereço</label>
                                                    <input id="endereco" name="endereco" value="{{$f->endereco}}" type="text" placeholder="" class="form-control">
                                                    
                                                </div>
                                                @endif
                                            </div>     
                                            <div class="text-right">
                                                <input id="id" name="id" value="{{$f->id}}" type="hidden"  class="form-control">
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
            var nif=document.getElementById("nif")
            var email=document.getElementById("email");
            var telefone=document.getElementById("telefone");
            var endereco=document.getElementById("endereco");

            var erro= document.getElementById("erro-registar");

       

            if(nome.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Nome";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(nif.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Nif";
                erro.removeAttribute('hidden');
                nif.focus();
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

            if(telefone.value == ''){
                
                erro.innerHTML="Por favor preencha o campo telefone";
                erro.removeAttribute('hidden');
                telefone.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(endereco.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Endereço";
                erro.removeAttribute('hidden');
                endereco.focus();
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