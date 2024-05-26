@extends('layout.template')
@section('title', 'Material Electronico')



@section('content')

<div class="card">
                                    <h3 class="card-header">Registar  Material Electrónico</h3>

                                    <div class="card-body">
                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
                                        @endif

                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>
                                        <form  action = "{{route('material-eletronico.salvar')}}"   method="Post" enctype="multipart/form-data" id="form-registar">
                                        @csrf

                                            <div class="row">

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="numimobilizado" class="col-form-label">Nº Imobilizado</label>
                                                    <input id="numimobilizado" name="numimobilizado" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Descrição</label>
                                                    <input id="descricao" name="descricao" type="text" placeholder="" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Tipo de Aquisição</label>
                                                   <select id="tipoaquisicao" onchange="habilitarDesabilitar()" name="tipoaquisicao" class="form-control form-control-sm">
                                                       <option value="Selecione">Selecione</option>
                                                     @if(isset($tipo))
                                                       
                                                           @foreach($tipo as $t)
                                                           <option value="{{$t->id}}">{{$t->descricao}}</option>
                                                           @endforeach
                                                       
                                                     @endif
                                                       
                                                   </select>
                                               </div>



                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Custo aquisição (Kz)</label>
                                                    <input id="valoraquisicao" onkeyup="changeValue(this)" name="valoraquisicao" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                    <label for="inputText11">Custo aquisição (USD)</label>
                                                    <input id="Custo_aquisição_usd" onkeyup="changeValue(this)" type="text" name="Custo_aquisição_usd" placeholder="" class="form-control">
                                                 </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputText12" class="col-form-label">Custo aquisição (euro)</label>
                                                    <input id="Custo_aquisição_euro" onkeyup="changeValue(this)" type="text" name="Custo_aquisição_euro"   class="form-control" placeholder="">
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="dataaquisicao">Data aquisição</label>
                                                    <input id="dataaquisicao" name="dataaquisicao" type="date" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="marca">Marca</label>
                                                    <input id="marca" name="marca" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="modelo">Modelo</label>
                                                    <input id="modelo" name="modelo" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="cor">Cor</label>
                                                    <input id="cor" name="cor" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="ram">RAM</label>
                                                    <input id="ram" name="ram" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="armazenamento">Armazenamento</label>
                                                    <input id="armazenamento" name="armazenamento" type="text" placeholder="" class="form-control">
                                                    
                                                </div>


                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Tipo</label>
                                                   <select name="tipo" id="tipo" class="form-control form-control-sm">
                                                       <option value="Selecione">Selecione</option>
                                                       <option value="Computador">Computador</option>
                                                       <option value="Telemóvel">Telemóvel</option>
                                                       <option value="Telemóvel">Impressora</option>
                                                       <option value="Telemóvel">Outro</option>
                                                   </select>
                                               </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Fornecedor</label>
                                                   <select name="fornecedor"  id="fornecedor" class="form-control form-control-sm">
                                                       <option value="Selecione">Selecione</option>
                                                     @if(isset($fornecedor))
                                                       
                                                           @foreach($fornecedor as $f)
                                                           <option value="{{$f->id}}">{{$f->nome}}</option>
                                                           @endforeach
                                                       
                                                     @endif
                                                       
                                                   </select>
                                               </div>

                                               <div class="form-group col-lg-6 col-md-12 margin-input">
                                                <label for="inputText4">Atribuir ao</label>
                                               <select name="pessoal"  id="pessoal" class="form-control form-control-sm">
                                                   <option value="Selecione">Selecione</option>

                                                 @if(isset($pessoal))
                                                   
                                                       @foreach($pessoal as $p)
                                                       <option value="{{$p->id}}">{{$p->nome}}</option>
                                                       @endforeach
                                                   
                                                 @endif
                                                   
                                               </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputText7" class="col-form-label">Vida útil (em Ano)</label>
                                                    <input id="vidautil" name="vidautil" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="vresidual"  class="col-form-label">Valor residual</label>
                                                    <input id="vresidual" name="vresidual" onkeyup="changeValue(this)"  type="text" class="form-control" >
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                    <label for="datautilizacao">Data início utilização</label>
                                                    <input id="datautilizacao"  name="datautilizacao" type="date"  class="form-control">
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

       if(tipoaquisicao.value != '2' && tipoaquisicao.value != '7'&&tipoaquisicao.value != '8' )
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
        var num_mobilizado=document.getElementById("numimobilizado");
        var descricao=document.getElementById("descricao");
        var valoraquisicao=document.getElementById("valoraquisicao");
        var tipoaquisicao=document.getElementById("tipoaquisicao");
        var dataaquisicao=document.getElementById("dataaquisicao");
        var marca=document.getElementById("marca");
        var modelo=document.getElementById("modelo");
        var cor=document.getElementById("cor");
        var ram=document.getElementById("ram");
        var armazenamento=document.getElementById("armazenamento");
        var tipo=document.getElementById("tipo");
        var fornecedor=document.getElementById("fornecedor");
        var pessoal=document.getElementById("pessoal");
        var Custo_aquisição_usd=document.getElementById("Custo_aquisição_usd");
        var Custo_aquisição_euro=document.getElementById("Custo_aquisição_euro");
        var erro= document.getElementById("erro-registar");
        var vidautil=document.getElementById("vidautil");
        var vresidual=document.getElementById("vresidual");
        var datautilizacao=document.getElementById("datautilizacao");

        if(num_mobilizado.value == ''){
            
            erro.innerHTML="Por favor preencha o campo Nº imobilizado";
            erro.removeAttribute('hidden');
            num_mobilizado.focus();
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

        if(Custo_aquisição_usd .value == ''){
               erro.innerHTML="Por favor preencha o campo Custo de aquisição USD";
               erro.removeAttribute('hidden');
               Custo_aquisição_usd.focus();
               return false;
           }else{
               erro.setAttribute('hidden', true);
           
           }
           if(Custo_aquisição_euro.value == ''){
               erro.innerHTML="Por favor preencha o campo Custo de aquisição Euro";
               erro.removeAttribute('hidden');
               Custo_aquisição_euro.focus();
               return false;
           }else{
               erro.setAttribute('hidden', true);
           
           }

        }

        if(dataaquisicao.value == ''){
            
            erro.innerHTML="Por favor preencha o campo data aquisicao";
            erro.removeAttribute('hidden');
            dataaquisicao.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(marca.value == ''){
            
            erro.innerHTML="Por favor preencha o campo marca";
            erro.removeAttribute('hidden');
            marca.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
        if(modelo.value == ''){
            
            erro.innerHTML="Por favor preencha o campo modelo";
            erro.removeAttribute('hidden');
            modelo.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
        if(cor.value == ''){
            
            erro.innerHTML="Por favor preencha o campo cor";
            erro.removeAttribute('hidden');
            cor.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
        if(ram.value == ''){
            
            erro.innerHTML="Por favor preencha o campo ram";
            erro.removeAttribute('hidden');
            ram.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(armazenamento.value == ''){
            
            erro.innerHTML="Por favor preencha o campo armazenamento";
            erro.removeAttribute('hidden');
            armazenamento.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(tipo.value == 'Selecione'){
            
            erro.innerHTML="Por favor Selecione um  tipo";
            erro.removeAttribute('hidden');
            tipo.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
        if(fornecedor.value == 'Selecione'){
            
            erro.innerHTML="Por favor Selecione um  fornecedor";
            erro.removeAttribute('hidden');
            fornecedor.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }


        if(pessoal.value == 'Selecione'){
            
            erro.innerHTML="Por favor Selecione um  pessoal";
            erro.removeAttribute('hidden');
            pessoal.focus();
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
         
         
         if(vresidual.value == ''){
           erro.innerHTML="Por favor preencha o campo valor residual";
           erro.removeAttribute('hidden');
           vresidual.focus();
           return false;
         }else{
              erro.setAttribute('hidden', true);
                                     
         }

        if(datautilizacao.value == ''){
            erro.innerHTML="Por favor preencha o campo data utilização";
             erro.removeAttribute('hidden');
            datautilizacao.focus();
            return false;
        }else{
               erro.setAttribute('hidden', true);
        }

        var dataAtual = new Date();
    
         // Converte a data digitada para um objeto Date
         var dataDigitadaObj = new Date(dataaquisicao.value);
                                    
           // Verifica se a data digitada é posterior à data atual
                                    
        if (dataDigitadaObj > dataAtual) {
                 erro.innerHTML="A data de aquisição não pode ser uma data futura, porfavor verifique";
                 erro.removeAttribute('hidden');
                dataaquisicao.focus();
             return false; // A data digitada é superior à data atual
         } else {
                    // A data digitada não é superior à data atual
              erro.setAttribute('hidden', true);
              formregistar.submit();
         }

});

});
                     
    
                     
    
 </script>
@endsection