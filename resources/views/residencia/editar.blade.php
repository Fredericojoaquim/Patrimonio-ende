@extends('layout.template')
@section('title', 'Residencia')


@section('content')

<div class="card">
                                    <h3 class="card-header">Registar Residencia</h3>

                                    <div class="card-body">
                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                        @endif

                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>
                                        <form  action = "{{url('residencia/update')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf
                                        {{ method_field('PUT') }}

                                        @if(isset($r))

                                            <div class="row">
                                                
                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="numimobilizado" class="col-form-label">Nº Imobilizado</label>
                                                    <input id="numimobilizado" value="{{$r->num_imobilizado}}" name="numimobilizado" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="descricao">Descrição</label>
                                                    <input id="descricao" value="{{$r->descricao}}" name="descricao" type="text" placeholder="" class="form-control">
                                                    
                                                </div>

                                                
                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="tipoaquisicao">Tipo de Aquisição</label>
                                                   <select name="tipoaquisicao" value="{{$r->tipo_aquisicao}}" id="tipoaquisicao" onchange="habilitarDesabilitar()" class="form-control form-control-sm">
                                                       <option value="Selecione">Selecione</option>
                                                       @if(isset($tipo))
                                                       
                                                           @foreach($tipo as $t)
                                                           <option value="{{$t->id}}">{{$t->descricao}}</option>
                                                           @endforeach
                                                   
                                                        @endif
                                                   
                                                   </select>
                                               </div>



                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="valoraquisicao" class="col-form-label">Valor aquisição</label>
                                                    <input id="valoraquisicao" value="{{number_format($r->valor_aquisicao, 2,",",".")}}" onkeyup="changeValue(this)" name="valoraquisicao" type="text" class="form-control">
                                                </div>


                                                <div class="form-group col-lg-6 margin-input">
                                                    <label for="Custo_aquisição_usd">Custo aquisição (USD)</label>
                                                    <input id="Custo_aquisição_usd" value="{{number_format($r->custo_aquisicao_usd, 2,",",".")}}"  onkeyup="changeValue(this)"  onkeypress="return somenteNumeros(event)" type="text" name="Custo_aquisiçao_usd" placeholder="" class="form-control">
                                                 </div>

                                                 <div class="form-group col-lg-6">
                                                    <label for="Custo_aquisição_euro" class="col-form-label">Custo aquisição (euro)</label>
                                                    <input id="Custo_aquisição_euro"  value="{{number_format($r->custo_aquisicao_euro, 2,",",".")}}"  onkeyup="changeValue(this)" type="text" name="Custo_aquisiçao_euro"   class="form-control" placeholder="">
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="finalidade">Finalidade</label>
                                                    <input id="finalidade" value="{{$r->finalidade}}" name="finalidade" type="text" placeholder="" class="form-control">
                                                    
                                                </div>
                                                

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="dataaquisicao">Data aquisição</label>
                                                    <input id="dataaquisicao" value="{{$r->data_aquisicao}}" name="dataaquisicao" type="date" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="dimensao">Dimensões</label>
                                                    <input id="dimensao" value="{{$r->dimensao}}" name="dimensao" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-6\ margin-input">
                                                    <label for="numcompartimento">Nº Compartimento</label>
                                                    <input id="numcompartimento" onkeypress="return somenteNumeros(event)" value="{{$r->num_compartimento}}" name="numcompartimento" type="text" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <label for="vidautil" class="col-form-label">Vida útil (em Ano)</label>
                                                    <input id="vidautil"  onkeypress="return somenteNumeros(event)"  value="{{$r->vida_util}}" name="vidautil" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="datautilizacao" class="col-form-label">Data início utilização</label>
                                                    <input id="datautilizacao"  onkeypress="return somenteNumeros(event)" value="{{$r->data_utilizacao}}" name="datautilizacao" type="date" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="vresidual" class="col-form-label">Valor Residual</label>
                                                    <input id="vresidual" onkeyup="changeValue(this)" value="{{number_format($r->valor_residual, 2,",",".")}}" onkeypress="return somenteNumeros(event)" name="vresidual" type="text" class="form-control">
                                                </div>

                                            </div>  
                                            <h4 class="card-header myh4">Endereço</h3>  
                                            <div class="row">

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                     <label for="provincia">Província</label>
                                                    <select  name="provincia" id="provincia" class="form-control form-control-sm">
                                                        <option value="">Selecione</option>
                                                        <option value="Bengo">Bengo</option>
                                                        <option value="Benguela">Benguela</option>
                                                        <option value="Bié" >Bié</option>
                                                        <option   value="Cabinda">Cabinda</option>
                                                        <option value="Cuando Cubango">Cuando Cubango</option>
                                                        <option value="Cuanza Norte">Cuanza Norte</option>
                                                        <option value="Cunene">Cunene</option>
                                                        <option value="Huambo">Huambo</option>
                                                        <option value="Huíla">Huíla</option>
                                                        <option value="Luanda">Luanda</option>
                                                        <option value="Lunda Norte">Lunda Norte</option>
                                                        <option value="Lunda Sul">Lunda Sul</option>
                                                        <option value="Malanje">Malanje</option>
                                                        <option value="Moxico">Moxico</option>
                                                        <option value="Namibe">Namibe</option>
                                                        <option value="Uíge">Uíge</option>
                                                        <option value="Zaire"> Zaire</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                <label for="municipio">Município</label>
                                                <input id="municipio" value="{{$r->municipio}}"  name="municipio" type="text" placeholder="" class="form-control">
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12">
                                                <label for="bairro" class="col-form-label">Bairro</label>
                                                <input id="bairro" value="{{$r->bairro}}"  name="bairro" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                <label for="rua">Rua</label>
                                                <input id="rua" name="rua" value="{{$r->rua}}"  type="text" placeholder="" class="form-control">

                                                </div>



                                            </div> 
                                            <div class="text-right">
                                                <input type="hidden" value="{{$r->endereco_id}}"  name="endereco_id" id="endereco_id">
                                                <input type="hidden" value="{{$r->codigo}}"  name="id" id="id">
                                                <button class="btn btn-success" id="btn-registar" type="submit">Alterar</button>
                                               
                                            </div>
                                        @endif
                                            
                                        </form>
                                    </div>
                     </div>

<script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 
<script>

//validação de numeros
function changeValue(event) {
	event.value = addCommas(event.value.replace(/\D/g, ''));
	calculate();
}

function addCommas(value) {
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function habilitarDesabilitar(){
                           
        var Custo_aquisição_usd=document.getElementById("Custo_aquisição_usd");
        var Custo_aquisição_euro=document.getElementById("Custo_aquisição_euro");
        var valor=document.getElementById("valoraquisicao");
        var tipoaquisicao=document.getElementById("tipoaquisicao");
                      
            if(tipoaquisicao.value != '2' && tipoaquisicao.value != '7' && tipoaquisicao.value != '8' )
                {                       
                               Custo_aquisição_usd.disabled = true;
                               Custo_aquisição_euro.disabled = true;
                               valor.disabled = true;
              }else{
                         Custo_aquisição_usd.disabled = false;
                         Custo_aquisição_euro.disabled = false;
                        valor.disabled = false;
                      
            }


}


$(document).ready(function(){

    btn_registar=document.getElementById("btn-registar");
    btn_registar.addEventListener('click', (event)=>{

        event.preventDefault();

        var formregistar=document.getElementById("form-registar");
        var numimobilizado=document.getElementById("numimobilizado");
        var descricao=document.getElementById("descricao");
        var tipoaquisicao=document.getElementById("tipoaquisicao");
        var valoraquisicao=document.getElementById("valoraquisicao");
        var Custo_aquisição_usd=document.getElementById("Custo_aquisição_usd");
        var Custo_aquisição_euro=document.getElementById("Custo_aquisição_euro");
        var finalidade=document.getElementById("finalidade");
        var dataaquisicao=document.getElementById("dataaquisicao");
        var dimensao=document.getElementById("dimensao");
        var numandar=document.getElementById("numandar");
        var numcompartimento=document.getElementById("numcompartimento");
        var provincia=document.getElementById("provincia");
        var municipio=document.getElementById("municipio");
        var bairro=document.getElementById("bairro");
        var rua=document.getElementById("rua");
        var vidautil=document.getElementById("vidautil");
        var datautilizacao=document.getElementById("datautilizacao");
        var vresidual=document.getElementById("vresidual");
 

        
        var erro= document.getElementById("erro-registar");

        if(numimobilizado.value == ''){
            
            erro.innerHTML="Por favor preencha o campo Nº imobilizado";
            erro.removeAttribute('hidden');
            numimobilizado.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(descricao.value == ''){
            
            erro.innerHTML="Por favor preencha o campo descricao";
            erro.removeAttribute('hidden');
            descricao.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
        if(tipoaquisicao.value == 'Selecione'){
            
            erro.innerHTML="Por favor selecione um tipo aquisicao";
            erro.removeAttribute('hidden');
            tipoaquisicao.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(!(tipoaquisicao.value != '2' && tipoaquisicao.value != '7'&& tipoaquisicao.value != '8' ))
        {

            
        if(valoraquisicao.value == ''){
            
            erro.innerHTML="Por favor preencha o campo custo aquisicao kz";
            erro.removeAttribute('hidden');
            valoraquisicao.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(Custo_aquisição_usd.value == ''){
            
            erro.innerHTML="Por favor preencha o campo custo aquisicao usd";
            erro.removeAttribute('hidden');
            Custo_aquisição_usd.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(Custo_aquisição_euro.value == ''){
            
            erro.innerHTML="Por favor preencha o campo custo aquisicao euro";
            erro.removeAttribute('hidden');
            Custo_aquisição_euro.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
    }


    if(finalidade.value == ''){
            
            erro.innerHTML="Por favor preencha o campo Finalidade";
            erro.removeAttribute('hidden');
            finalidade.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }



    if(dataaquisicao.value == ''){
            
            erro.innerHTML="Por favor preencha o campo data aquisição";
            erro.removeAttribute('hidden');
            dataaquisicao.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
     }
    
     if(diferencaData(dataaquisicao.value) > 0){
                erro.innerHTML="A data de Aquisição não pode ser uma data futura";
                erro.removeAttribute('hidden');
                dataaquisicao.focus();
                return false;
     }else{
                
         erro.setAttribute('hidden', true);
               // formregistar.submit();
             
    }

    if(dimensao.value == ''){
            
            erro.innerHTML="Por favor preencha o campo dimensão";
            erro.removeAttribute('hidden');
            dimensao.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
    }

    if(numcompartimento.value == ''){
            
            erro.innerHTML="Por favor preencha o campo Nº Compartimentos";
            erro.removeAttribute('hidden');
            numcompartimento.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
    }

    if(vidautil.value == ''){
        erro.innerHTML="Por favor preencha o campo Vida Util";
        erro.removeAttribute('hidden');
        vidautil.focus();
            return false;
        }else{
     erro.setAttribute('hidden', true);
             
     }

     if(datautilizacao.value == ''){
        erro.innerHTML="Por favor preencha o campo data inicio de utilização";
        erro.removeAttribute('hidden');
        datautilizacao.focus();
            return false;
        }else{
     erro.setAttribute('hidden', true);
             
     }


     if(vresidual.value == ''){
        erro.innerHTML="Por favor preencha o campo valor residual";
        erro.removeAttribute('hidden');
        vresidual.focus();
            return false;
        }else{
     erro.setAttribute('hidden', true);
             
     }


    
    if(provincia.value == 'Selecione'){
            
            erro.innerHTML="Por favor selecione uma  província";
            erro.removeAttribute('hidden');
            provincia.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
    }

    if(municipio.value == ''){
            
            erro.innerHTML="Por favor preencha o campo município";
            erro.removeAttribute('hidden');
            municipio.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
    }

    if(bairro.value == ''){
            
            erro.innerHTML="Por favor preencha o campo Bairro";
            erro.removeAttribute('hidden');
            bairro.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
    }

    if(rua.value == ''){
            
            erro.innerHTML="Por favor preencha o campo rua";
            erro.removeAttribute('hidden');
            rua.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
            formregistar.submit();
    }


    });
});




</script>

@endsection