@extends('layout.template')
@section('title', 'Motivo abate')


@section('content')

<div class="card">
                                    <h3 class="card-header">Registar Motivo Abates</h3>

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
                                        <form  action = "{{url('motivo-abate/salvar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf

                                            <div class="row">

                                                <div class="form-group col-lg-12 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Descrição</label>
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



$(document).ready(function(){
    btn_registar=document.getElementById("btn-registar");
    btn_registar.addEventListener('click', (event)=>{
            event.preventDefault();
            var formregistar=document.getElementById("form-registar");
            var descricao=document.getElementById("descricao");
            var erro= document.getElementById("erro-registar");

       

            if(descricao.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Descrição";
                erro.removeAttribute('hidden');
                escricao.focus();
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