@extends('layout.template')
@section('title', 'Utilizador')


@section('content')

<div class="card">
                                    <h3 class="card-header">Registar Pessoal</h3>

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
                                        <form  action = "{{url('pessoal/update')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf
                                        {{ method_field('PUT') }}

                                        @if(isset($p))
                                        <div class="row">
                                            <div class="form-group col-lg-6 col-md-12">

                                                <label for="inputText3" class="col-form-label">Nome</label>
                                                <input id="nome" value="{{$p->nome}}" name="nome" type="text" class="form-control">
                                            </div>


                                            <div class="form-group col-lg-6 col-md-12">

                                                <label for="inputText3" class="col-form-label">Data Nascimento</label>
                                                <input id="datanasc" value="{{$p->datanasc}}" name="datanasc" type="date" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6 col-md-12">

                                                <label for="inputText3" class="col-form-label">Email</label>
                                                <input id="email" value="{{$p->email}}" name="email" type="email" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6 col-md-12">
                                                <label for="telefone" class="col-form-label">Telefone</label>
                                                <input id="telefone" value="{{$p->telefone}}" name="telefone" type="text" class="form-control">
                                           </div>

                                            <div class="form-group col-lg-6 col-md-12 margin-input">
                                                <label for="perfil">Departamento</label>
                                               <select name="departamento" id="departamento" class="form-control form-control-sm">
                                                   <option value="Selecione">Selecione</option>
                                                   @if(isset($dep))
                                                   
                                                       @foreach($dep as $d)
                                                       <option value="{{$d->id}}">{{$d->descricao}}</option>
                                                       @endforeach
                                               
                                                    @endif
                                               </select>
                                           </div>

                                           <div class="form-group col-lg-6 col-md-12">
                                            <label for="funcao" class="col-form-label">Função</label>
                                            <input id="funcao" value="{{$p->funcao}}" name="funcao" type="text" class="form-control">
                                            <input id="id" value="{{$p->id}}" name="id" type="hidden" class="form-control">
                                          </div>

                                          

                                           
                                           
                             
                                        </div> 
                                            
                                        @endif

                                         
                                            <div class="text-right">
                                                <button class="btn btn-success" id="btn-registar" type="submit">Registar</button>
                                                
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
            var datanasc=document.getElementById("datanasc");
            var email=document.getElementById("email");
            var funcao=document.getElementById("funcao");
            var telefone=document.getElementById("telefone");
            var departamento=document.getElementById("departamento");
            var erro= document.getElementById("erro-registar");

       

            if(nome.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Nome";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(datanasc.value == ''){
                
                erro.innerHTML="Por favor preencha a data de nascimento";
                erro.removeAttribute('hidden');
                datanasc.focus();
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

           
            if(departamento.value == 'Selecione'){
                
                erro.innerHTML="Por favor Selecione o departamento";
                erro.removeAttribute('hidden');
                departamento.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(funcao.value == ''){
                
                erro.innerHTML="Por favor Selecione a função";
                erro.removeAttribute('hidden');
                departamento.focus();
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