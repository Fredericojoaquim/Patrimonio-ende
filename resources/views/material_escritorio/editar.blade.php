@extends('layout.template')
@section('title', 'Material escritório')


@section('content')

                 <div class="card">
                                    <h5 class="card-header">Alterar Material Escritório</h5>

                                    <div class="card-body">

                                        @if (@isset($sms))

                                        <div class="alert alert-success" role="alert">
                                            <p>{{$sms}}</p>
                                        </div>
 
                                        @endif

                                        <div class="alert alert-danger" id="erro-registar" hidden>

                                        </div>

                                        <form action="{{url('material-escritorio/update')}}" method="POST" id="form-registar">
                                            @csrf
                                            {{ method_field('PUT') }}

                                            <div class="row">
                                                @if(isset($m))
                                                    
                                                

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="num_mobilizado" class="col-form-label">Nº mobilizado</label>
                                                    <input id="num_mobilizado" value="{{$m->num_mobilizado}}" name="num_mobilizado" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputText4">Fornecedor</label>
                                                        <select name="fornecedor"  id="fornecedor" class="form-control form-control-sm">
                                                            <option value="Selecione">Selecione</option>
                                                            @if(isset($for))
                                                            
                                                                @foreach($for as $f)
                                                                <option value="{{$f->id}}">{{$f->nome}}</option>
                                                                @endforeach
                                                        
                                                                @endif
                                                        
                                                        </select>
                                                 </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="descricao">Descrição</label>
                                                    <input id="descricao" value="{{$m->descricao}}" name="descricao" type="text" class="form-control">
                                                    
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputText7" class="col-form-label">Vida útil (em Ano)</label>
                                                    <input id="vidautil" value="{{$m->vida_util}}" name="vidautil" type="text" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="tipoaquisicao">Tipo de Aquisição</label>
                                                <select onchange="habilitarDesabilitar()" name="tipoaquisicao" id="tipoaquisicao" class="form-control form-control-sm">
                                                    <option value="Selecione">Selecione</option>
                                                    @if(isset($tipo))
                                                    
                                                        @foreach($tipo as $t)
                                                        <option value="{{$t->id}}">{{$t->descricao}}</option>
                                                        @endforeach
                                                
                                                        @endif
                                                
                                                </select>
                                            </div>
                     

                                                <div class="form-group col-lg-6">
                                                        <label for="valor" class="col-form-label">Custo de aquisição (kz)</label>
                                                        <input id="valor" onkeyup="changeValue(this)" value="{{$m->valor_aquisicao}}" name="valor"  class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                    <label for="inputText11">Custo aquisição (USD)</label>
                                                    <input id="Custo_aquisição_usd" onkeyup="changeValue(this)" value="{{$m->custo_aquisicao_usd}}" type="text" name="Custo_aquisição_usd" placeholder="" class="form-control">
                                                 </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputText12" class="col-form-label">Custo aquisição (euro)</label>
                                                    <input id="Custo_aquisição_euro" onkeyup="changeValue(this)" value="{{$m->custo_aquisicao_euro}}" type="text" name="Custo_aquisição_euro"   class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                        <label for="dataaquisicao">Data de Aquisição</label>
                                                        <input id="dataaquisicao" value="{{$m->data_aquisicao}}"  name="dataaquisicao" type="date" placeholder="Password" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">

                                                    <label for="input-select">Atribuir para</label>
                                                    <select class="form-control" name="pessoal" id="pessoal">
                                                        <option value="Selecione">Selecione</option>
                                                        @if(isset($pessoal))
                                                       
                                                        @foreach($pessoal as $p)
                                                        <option value="{{$p->id}}">{{$p->nome}}</option>
                                                        @endforeach
                                                
                                                     @endif
                                                    </select>
                                               </div>


                                                <div class="form-group col-lg-6">
                                                    <label for="marca" class="col-form-label">Marca</label>
                                                    <input id="marca" value="{{$m->marca}}" name="marca" type="text" class="form-control" >
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="tipomovel">Tipo</label>
                                                <select name="tipomovel" id="tipomovel" class="form-control form-control-sm">
                                                    <option value="Selecione">Selecione</option> 
                                                    <option value="Mesa">Mesa</option> 
                                                    <option value="Secretária">Secretária</option> 
                                                    <option value="Sofá">Sofá</option>  
                                                    <option value="Cadeira de escritório">Cadeira de escritório</option>  
                                                    <option value="Cadeira de escritório">Armário</option>    
                                                </select>
                                               
                                                    </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="cor" class="col-form-label">Cor</label>
                                                    <input id="cor" value="{{$m->cor}}" name="cor" type="text" class="form-control" >
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="finalidade"  class="col-form-label">Finalidade</label>
                                                    <input id="finalidade" value="{{$m->finalidade}}" name="finalidade"  type="text" class="form-control" >
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="vresidual"  class="col-form-label">Valor residual</label>
                                                    <input id="vresidual" name="vresidual" value="{{$m->valor_residual}}"  type="text" class="form-control" >
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                    <label for="datautilizacao">Data início utilização</label>
                                                    <input id="datautilizacao" value="{{$m->data_utilizacao}}"  name="datautilizacao" type="date"  class="form-control">
                                                </div>

                                              
                                                @endif
                                           </div>

                                           
                                            
                                            
                                            <div class="text-right">
                                                <button class="btn btn-success" id="btn-registar">Alterar</button>
                                                <input type="hidden" value="{{$m->id}}" name="id">
                                                
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
       var valor=document.getElementById("valor");
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
             var num_mobilizado=document.getElementById("num_mobilizado");
             var fornecedor=document.getElementById("fornecedor");
             var descricao=document.getElementById("descricao");
             var valor=document.getElementById("valor");
             var dataaquisicao=document.getElementById("dataaquisicao");
             var pessoal=document.getElementById("pessoal");
             var tipoaquisicao=document.getElementById("tipoaquisicao");
             var marca=document.getElementById("marca");
             var tipomovel=document.getElementById("tipomovel");
             var cor=document.getElementById("cor");
             var finalidade=document.getElementById("finalidade");
             var Custo_aquisição_usd=document.getElementById("Custo_aquisição_usd");
             var Custo_aquisição_euro=document.getElementById("Custo_aquisição_euro");
             var vidautil=document.getElementById("vidautil");
             var vresidual=document.getElementById("vresidual");
             var datautilizacao=document.getElementById("datautilizacao");
             
            
             var erro= document.getElementById("erro-registar");
 
        
 
             if(num_mobilizado.value == ''){
                 
                 erro.innerHTML="Por favor preencha o campo Nº imobilizado";
                 erro.removeAttribute('hidden');
                 num_mobilizado.focus();
                 return false;
             }else{
                 erro.setAttribute('hidden', true);
             }
 
             if(fornecedor.value == 'Selecione'){
                 erro.innerHTML="Por favor selecione um fornecedor";
                 erro.removeAttribute('hidden');
                 fornecedor.focus();
                 return false;
             }else{
                 erro.setAttribute('hidden', true);
                 
             }

             if(descricao.value == ''){
                 erro.innerHTML="Por favor preencha o campo descrição";
                 erro.removeAttribute('hidden');
                 descricao.focus();
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

             if(tipoaquisicao.value == 'Selecione'){
                 erro.innerHTML="Por favor preencha o campo tipo aquisição";
                 erro.removeAttribute('hidden');
                 tipoaquisicao.focus();
                 return false;
             }else{
                 erro.setAttribute('hidden', true);
                
             }
             if(!(tipoaquisicao.value != '2' && tipoaquisicao.value != '7' && tipoaquisicao.value != '8') ){


             if(valor.value == ''){
                 erro.innerHTML="Por favor preencha o campo Custo aquisição Kz";
                 erro.removeAttribute('hidden');
                 valor.focus();
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
                 erro.innerHTML="Por favor preencha o campo data aquisição";
                 erro.removeAttribute('hidden');
                 dataaquisicao.focus();
                 return false;
             }else{
                 erro.setAttribute('hidden', true);
                
             }

             if(pessoal.value == 'Selecione'){
                 erro.innerHTML="Por favor preencha o campo pessoal";
                 erro.removeAttribute('hidden');
                 pessoal.focus();
                 return false;
             }else{
                 erro.setAttribute('hidden', true);
                
             }

             if(marca.value == ''){
                 erro.innerHTML="Por favor preencha o campo Marca";
                 erro.removeAttribute('hidden');
                 marca.focus();
                 return false;
             }else{
                 erro.setAttribute('hidden', true);
                
             }

             if(tipomovel.value == 'Selecione'){
                 erro.innerHTML="Por favor Selecione o  Tipo";
                 erro.removeAttribute('hidden');
                 tipomovel.focus();
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


             if(finalidade.value == ''){
                 erro.innerHTML="Por favor preencha o campo Finalidade";
                 erro.removeAttribute('hidden');
                 finalidade.focus();
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
                formregistar.submit();
            }

     });
 
      });
 </script>
@endsection