@extends('layout.template')
@section('title', 'Veículos')


@section('content')

                 <div class="card">
                                    <h3 class="card-header">Registar Veículo</h3>

                                    <div class="card-body">

                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                        @endif
                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>

                                        <form  action="{{url('veiculo/update')}}" method="POST" id="form-registar">
                                                 @csrf
                                                 {{ method_field('PUT') }}
                                                 @if(isset($v))

                                            <div class="row">
                                             
                                                    
                                                <div class="form-group col-lg-6 margin-input">

                                                        <label for="input-select">Tipo de Veículo</label>
                                                        <select id="tipoveiculo" class="form-control" name="tipoveiculo" id="input-select">
                                                            <option value="Selecione">Selecione</option>
                                                            <option value="Motociclo">Motociclo</option>
                                                            <option value="Automóvel">Automóvel</option>
                                                        </select>
                                                   </div>

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Marca</label>
                                                    <input id="marca" value="{{$v->marca}}" name="marca" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Modelo</label>
                                                    <input id="modelo" value="{{$v->modelo}}" name="modelo" type="text" placeholder="" class="form-control">
                                                    
                                                </div>
                     

                                                <div class="form-group col-lg-6">
                                                        <label for="inputText5" class="col-form-label">Matricula</label>
                                                        <input id="matricula" value="{{$v->matricula}}" name="matricula" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                        <label for="inputText6">Nº Chassi</label>
                                                        <input id="num_chassi" value="{{$v->numero_chassi}}" name="num_chassi" type="text" placeholder="" class="form-control">
                                                </div>


                                                <div class="form-group col-lg-6">
                                                        <label for="inputText7" class="col-form-label">Nº Motor</label>
                                                        <input id="num_motor" value="{{$v->num_motor}}" name="num_motor" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                        <label for="inputText7" class="col-form-label">Cor</label>
                                                        <input id="cor" name="cor" value="{{$v->cor}}" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputText7" class="col-form-label">Vida útil (em Ano)</label>
                                                    <input id="vidautil" value="{{$v->vida_util}}" onkeypress="return somenteNumeros(event)" name="vidautil" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">

                                                    <label for="input-select">Caixa de velocidade</label>
                                                    <select id="caixa_velocidade" class="form-control" name="caixa_velocidade" id="input-select">
                                                        <option value="Selecione">Selecione</option>
                                                        <option value="Manual">Manual</option>
                                                        <option value="Automático">Automático</option>
                                                    </select>
                                               </div>

                                                <div class="form-group col-lg-6">
                                                        <label for="inputText8" class="col-form-label">Data fabríco</label>
                                                        <input id="data_fabrico" value="{{$v->data_fabrico}}" type="date" name="data_fabrico" class="form-control" placeholder="">
                                                </div>
                                                
                                                <div class="form-group col-lg-6 margin-input">

                                                        <label for="input-select">Tipo Combustível</label>
                                                        <select id="tipocombustivel" class="form-control" name="tipocombustivel" id="input-select">
                                                            <option value="Selecione">Selecione</option>
                                                            <option value="Gasolina">Gasolina</option>
                                                            <option value="Gasóleo">Gasóleo</option>
                                                            <option value="Outro">Outro</option>
                                                        </select>
                                                   </div>

                                                   <div class="form-group col-lg-6 margin-input">

                                                        <label for="input-select">Departamento Beneficiário</label>
                                                        <select id="departamento" class="form-control" name="departamento" id="input-select">
                                                            <option value="Selecione">Selecione</option>
                                                            @if(isset($dep))
                                                           
                                                            @foreach($dep as $d)
                                                            <option value="{{$d->id}}">{{$d->descricao}}</option>
                                                            @endforeach
                                                    
                                                         @endif
                                                        </select>
                                                   </div>

                                                   <div class="form-group col-lg-6 col-md-12 margin-input">
                                                        <label for="inputText4">Tipo de Aquisição</label>
                                                       <select onchange="habilitarDesabilitar()" name="tipoaquisicao" id="tipoaquisicao" class="form-control form-control-sm">
                                                           <option   value="Selecione">Selecione</option>
                                                           @if(isset($tipo))
                                                           
                                                               @foreach($tipo as $t)
                                                               <option value="{{$t->id}}">{{$t->descricao}}</option>
                                                               @endforeach
                                                       
                                                            @endif
                                                       
                                                       </select>
                                                   </div>


                                                <div class="form-group col-lg-6">
                                                        <label for="inputText10" class="col-form-label">Custo aquisição (KZ)</label>
                                                        <input id="Custo_aquisição_kz" onkeyup="changeValue(this)"  value="{{$v->custo_aquisicao_kz}}" type="text" name="Custo_aquisição_kz" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                        <label for="inputText11">Custo aquisição (USD)</label>
                                                        <input id="Custo_aquisição_usd" onkeyup="changeValue(this)" value="{{$v->custo_aquisicao_usd}}" type="text" name="Custo_aquisição_usd" placeholder="" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                        <label for="inputText12" class="col-form-label">Custo aquisição (euro)</label>
                                                        <input id="Custo_aquisição_euro" onkeyup="changeValue(this)" value="{{$v->custo_aquisicao_euro}}" type="text" name="Custo_aquisição_euro"   class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <label for="inputText12" class="col-form-label">Data aquisição</label>
                                                    <input id="dataAquisicao" value="{{$v->dataAquisicao}}" type="date" name="dataAquisicao"   class="form-control" placeholder="">
                                                </div><br><br>
                                               
                                                <div class="form-group col-lg-12 my_margin text-center">
                                                    <h3 class="text-center">INFORMAÇÕES DO SEGURO</h3>
                                                    <strong><p class="text-center">Tem seguro?</p></strong>
    
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="nao_seguros" onclick="habilitaseguro()"   name="nao_seguro"  class="custom-control-input" value="sim"><span class="custom-control-label">SIM</span>
                                                    </label>
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio"  id="nao_seguro" onclick="habilitaseguro()"  name="nao_seguro" class="custom-control-input" value="não"><span class="custom-control-label">NÃO</span>
                                                    </label>
                                                    
                                                </div><br>
     
                                        </div>

                                        @endif
                                        <div class="row" id="div_seguro" hidden> 
                                            <div class="form-group col-lg-6">
                                                <label for="inputText13">Nome seguradora</label>
                                                <input id="nome_seguradora" type="text"  name="nome_seguradora"  placeholder="" class="form-control">
                                             </div>


                                            <div class="form-group col-lg-6">
                                                    <label for="inputText4" class="col-form-label">Cobertura</label>
                                                    <input id="cobertura" type="text"  name="cobertura"  class="form-control" placeholder="">
                                            </div>

                                            <div class="form-group col-lg-6 margin-input">
                                                    <label for="inputPassword">Apólice</label>
                                                    <input id="apolice" type="text"   name="apolice"  placeholder="" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6 margin-input">
                                                    <label for="valor_seguro">Valor</label>
                                                    <input id="valor_seguro" type="text"   name="valor_seguro"  placeholder="" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                    <label for="datainicio" class="col-form-label">Data início</label>
                                                    <input id="datainicio" type="date"  name="datainicio"  class="form-control" placeholder="">
                                            </div>

                            

                                            <div class="form-group col-lg-6 margin-input">
                                                    <label for="datafim">Data fim</label>
                                                    <input id="datafim" type="date"  name="datafim" placeholder="" class="form-control">
                                            </div>
                                            
                                          

                                        </div>

                                           
                                            
                                            <div class="text-right">
                                                <input type="hidden" value="{{$v->id}}" name="id" id="id">
                                                <button class="btn btn-success" id="btn-registar">Alterar</button>
                                                <button class="btn btn-danger" type="reset">Cancelar</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                     </div>

<script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 
<script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> 
<script>



function habilitaseguro()
{
    
   // var nao=document.getElementById("nao_seguro");
  
    var check=document.querySelector('input[name="nao_seguro"]:checked').value;
    var div_seguro=document.getElementById("div_seguro");
     if(check=='sim')
     {
        div_seguro.removeAttribute('hidden');

     }else{
        div_seguro.setAttribute('hidden', true);
     }
    


}


function habilitarDesabilitar(){
                           
            var Custo_aquisição_kz=document.getElementById("Custo_aquisição_kz");
            var Custo_aquisição_usd=document.getElementById("Custo_aquisição_usd");
            var Custo_aquisição_euro=document.getElementById("Custo_aquisição_euro");
            var tipoaquisicao=document.getElementById("tipoaquisicao");
                      
            if(tipoaquisicao.value != '2' && tipoaquisicao.value != '7' && tipoaquisicao.value != '8' )
             {                       
                    Custo_aquisição_usd.disabled = true;
                     Custo_aquisição_euro.disabled = true;
                    Custo_aquisição_kz.disabled = true;
           }else{
                    Custo_aquisição_usd.disabled = false;
                    Custo_aquisição_euro.disabled = false;
                     Custo_aquisição_kz.disabled = false;
                      
            }
      }



$(document).ready(function(){

    btn_registar=document.getElementById("btn-registar");
    btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();

            var formregistar=document.getElementById("form-registar");
            var tipoveiculo=document.getElementById("tipoveiculo");
            var marca=document.getElementById("marca");
            var modelo=document.getElementById("modelo");
            var matricula=document.getElementById("matricula");
            var num_chassi=document.getElementById("num_chassi");
            var num_motor=document.getElementById("num_motor");
            var cor=document.getElementById("cor");
            var caixa_velocidade=document.getElementById("caixa_velocidade");
            var data_fabrico=document.getElementById("data_fabrico");
            var tipocombustivel=document.getElementById("tipocombustivel");
            var departamento=document.getElementById("departamento");
            var tipoaquisicao=document.getElementById("tipoaquisicao");
            var Custo_aquisição_kz=document.getElementById("Custo_aquisição_kz");
            var Custo_aquisição_usd=document.getElementById("Custo_aquisição_usd");
            var Custo_aquisição_euro=document.getElementById("Custo_aquisição_euro");
            var vidautil=document.getElementById("vidautil");
            var dataAquisicao=document.getElementById("dataAquisicao");
            
            var erro= document.getElementById("erro-registar");
           

          

            if(tipoveiculo.value == 'Selecione'){
                
                erro.innerHTML="Por favor selecione o tipo de veículo";
                erro.removeAttribute('hidden');
             
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

            if(matricula.value == ''){
                erro.innerHTML="Por favor preencha o campo matrícula";
                erro.removeAttribute('hidden');
                matricula.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }

            if(num_chassi.value == ''){
                erro.innerHTML="Por favor preencha o campo Nº de Chassi";
                erro.removeAttribute('hidden');
                num_chassi.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }
            if(num_motor.value == ''){
                erro.innerHTML="Por favor preencha o campo Nº de Motor";
                erro.removeAttribute('hidden');
                num_motor.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }

            if(cor.value == ''){
                erro.innerHTML="Por favor preencha o campo Cor";
                erro.removeAttribute('hidden');
                cor.focus();
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
            if( caixa_velocidade.value == 'Selecione'){
                erro.innerHTML="Por favor preencha o campo Caixa de Velocidade";
                erro.removeAttribute('hidden');
                caixa_velocidade.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }
            if( data_fabrico.value == ''){
                erro.innerHTML="Por favor preencha o campo Data Fabríco";
                erro.removeAttribute('hidden');
                data_fabrico.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }
            if( tipocombustivel.value == 'Selecione'){
                erro.innerHTML="Por favor preencha o campo Tipo Combustível";
                erro.removeAttribute('hidden');
                tipocombustivel.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }
            if(departamento.value == 'Selecione'){
                erro.innerHTML="Por favor preencha o campo Departamento";
                erro.removeAttribute('hidden');
                departamento.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }

            if(tipoaquisicao.value == 'Selecione'){
                erro.innerHTML="Por favor preencha o campo Tipo de Aquisição";
                erro.removeAttribute('hidden');
                tipoaquisicao.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
             
            }
           

                                  
            if(!(tipoaquisicao.value != '2' && tipoaquisicao.value != '7' && tipoaquisicao.value != '8' ))
            {
            if(Custo_aquisição_kz.value == ''){
                erro.innerHTML="Por favor preencha o campo Custo de aquisição Kz";
                erro.removeAttribute('hidden');
                Custo_aquisição_kz.focus();
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
              //  formregistar.submit();
             
            }

            if(diferencaData(data_fabrico.value) > 0){
                erro.innerHTML="A data de fabrico não pode ser uma data futura";
                erro.removeAttribute('hidden');
                data_fabrico.focus();
                return false;
            }else{
                
                erro.setAttribute('hidden', true);
               // formregistar.submit();
             
            }

            if(diferencaData(dataAquisicao.value) > 0){
                erro.innerHTML="A data de Aquisição não pode ser uma data futura";
                erro.removeAttribute('hidden');
                dataAquisicao.focus();
                return false;
            }else{
                
                erro.setAttribute('hidden', true);
                formregistar.submit();
             
            }
        }else{

            if(dataAquisicao.value == ''){
                erro.innerHTML="Por favor preencha o campo Data aquisição";
                erro.removeAttribute('hidden');
                dataAquisicao.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
               // formregistar.submit();
             
            }

            //
            if(diferencaData(data_fabrico.value) > 0){
                erro.innerHTML="A data de fabrico não pode ser uma data futura";
                erro.removeAttribute('hidden');
                data_fabrico.focus();
                return false;
            }else{
                
                erro.setAttribute('hidden', true);
               // formregistar.submit();
             
            }

            if(diferencaData(dataAquisicao.value) > 0){
                erro.innerHTML="A data de Aquisição não pode ser uma data futura";
                erro.removeAttribute('hidden');
                dataAquisicao.focus();
                return false;
            }else{
                
                erro.setAttribute('hidden', true);
               formregistar.submit();
             
            }



            

          
        }

            

          //  
    });

     });
</script>
@endsection