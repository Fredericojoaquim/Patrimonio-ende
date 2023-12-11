@extends('layout.template')
@section('title', 'Departamentos')


@section('content')

<div class="card">
                                    <h3 class="card-header">Alterar Departamento</h3>

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
                                        <form  action = "{{url('departamento/update')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf
                                        {{ method_field('PUT') }}

                                            <div class="row">
                                                @if(isset($d))
                                                    
                                               

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Descrição</label>
                                                    <input id="descricao" value="{{$d->descricao}}" name="descricao" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Sigla</label>
                                                    <input id="sigla" value="{{$d->sigla}}" name="sigla" type="text" placeholder="" class="form-control">  
                                                </div>
                                            @endif
                                            </div>     
                                            <div class="text-right">
                                                <input id="id" value="{{$d->id}}" name="id" type="hidden" >  
                                                <button class="btn btn-success" id="btn-registar" type="submit">Alterar</button>
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
            var sigla=document.getElementById("sigla")
            
           
            var erro= document.getElementById("erro-registar");

       

            if(descricao.value == ''){
                
                erro.innerHTML="Por favor preencha o campo Descrição";
                erro.removeAttribute('hidden');
                escricao.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(sigla.value == ''){
                erro.innerHTML="Por favor preencha o campo Sigla";
                erro.removeAttribute('hidden');
                sigla.focus();
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