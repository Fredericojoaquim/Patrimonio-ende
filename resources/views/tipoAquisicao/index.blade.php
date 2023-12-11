@extends('layout.template')
@section('title', 'Tipo Aquisição')


@section('content')

<div class="card">
                                    <h3 class="card-header">Tipo Aquisição</h3>

                                    <div class="card-body">
                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                        @endif
                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>
                                        <form  action = "{{url('tipoaquisicao/registar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf

                                            <div class="row">

                                                <div class="form-group col-lg-12 col-md-12">

                                                    <label for="descricao" class="col-form-label">Tipo aquisição</label>
                                                    <input id="descricao" name="descricao" type="text" class="form-control">
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
            var descricao=document.getElementById("descricao");
            var erro= document.getElementById("erro-registar");

       

            if(descricao.value == ''){
                
                erro.innerHTML="Por favor preencha o campo descrição";
                erro.removeAttribute('hidden');
                descricao.focus();
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