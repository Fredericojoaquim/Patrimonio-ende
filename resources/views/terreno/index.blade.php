@extends('layout.template')
@section('title', 'Terreno')


@section('content')

<div class="card">
                                    <h3 class="card-header">Registar Terreno</h3>

                                    <div class="card-body">
                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                        @endif

                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>
                                        <form  action = "{{url('imoveis/terreno/registar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf

                                            <div class="row">

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="numimobilizado" class="col-form-label">Nº Imobilizado</label>
                                                    <input id="numimobilizado" name="numimobilizado" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="descricao">Descrição</label>
                                                    <input id="descricao" name="descricao" type="text" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="tipoaquisicao">Tipo de Aquisição</label>
                                                   <select name="tipoaquisicao" id="tipoaquisicao" onchange="habilitarDesabilitar()" class="form-control form-control-sm">
                                                       <option value="Selecione">Selecione</option>
                                                       @if(isset($tipo))
                                                       
                                                           @foreach($tipo as $t)
                                                           <option value="{{$t->id}}">{{$t->descricao}}</option>
                                                           @endforeach
                                                   
                                                        @endif
                                                   
                                                   </select>
                                               </div>



                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="valoraquisicao" class="col-form-label">custo aquisição (kz)</label>
                                                    <input id="valoraquisicao" name="valoraquisicao" onkeyup="changeValue(this)" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                    <label for="Custo_aquisição_usd">Custo aquisição (USD)</label>
                                                    <input id="Custo_aquisição_usd"  onkeyup="changeValue(this)" type="text" name="Custo_aquisiçao_usd" placeholder="" class="form-control">
                                                 </div>

                                                 <div class="form-group col-lg-6">
                                                    <label for="Custo_aquisição_euro" class="col-form-label">Custo aquisição (euro)</label>
                                                    <input id="Custo_aquisição_euro"  onkeyup="changeValue(this)" type="text" name="Custo_aquisiçao_euro"   class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="finalidade">Finalidade</label>
                                                    <input id="finalidade" name="finalidade" type="text" placeholder="" class="form-control">
                                                    
                                                </div>
                                                
                                                

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="dataaquisicao">Data aquisição</label>
                                                    <input id="dataaquisicao" name="dataaquisicao" type="date" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="dimensao">Dimensões</label>
                                                    <input id="dimensao" name="dimensao" type="text" placeholder="" class="form-control">  
                                                </div>

                                               

                                               

                                               
                                            </div>  
                                            <h4 class="card-header myh4">Endereço</h3>  
                                            <div class="row">

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                     <label for="provincia">Província</label>
                                                    <select id="provincia" name="provincia" class="form-control form-control-sm">
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
                                                <input id="municipio" name="municipio" type="text" placeholder="" class="form-control">
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12">
                                                <label for="bairro" class="col-form-label">Bairro</label>
                                                <input id="bairro" name="bairro" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                <label for="rua">Rua</label>
                                                <input id="rua" name="rua" type="text" placeholder="" class="form-control">

                                                </div>



                                            </div> 
                                            <div class="text-right">
                                                <button class="btn btn-success" id="btn-registar" type="submit">Registar</button>
                                                
                                            </div>
                                            
                                        </form>
                                    </div>
                     </div>

<script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 


<script>

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
var provincia=document.getElementById("provincia");
var municipio=document.getElementById("municipio");
var bairro=document.getElementById("bairro");
var rua=document.getElementById("rua");


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