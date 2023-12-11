<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprovativo</title>
</head>

<style>
    *{
        margin:0;
        padding:0;
        border:0;
    }
</style>

<body>

    <div style="width: 750px; padding:30px;" >
        <div class="col-12" id="logotipo">
            <img src="{{ public_path('img/logo.png')}}" alt="" style="width: 250x; height: 130px;  ">          
            
        </div><br>
        <h3 style="height: 40px; text-align: center">SISTEMA DE GESTÃO DE PATRIMÓNIO ENDE</h3><br><br><br>
        <table   style="border: 1px solid black; margin: 0 auto; width: 100%; text-align:center;">
            <tr style="border: 1px solid black; background-color:black; color:white; height: 40px;">
                <td style="border: 1px solid black; "> Nº CADASTRO:{{$v->id}} </td>
                <td style="border: 1px solid black;">COMPROVATIVO DE CADASTRO VEÍCULO</td>
                @php
                    $data = new DateTime($v->created_at);
                @endphp
                <td style="border: 1px solid black;"> DATA:{{$data->format('d-m-Y')}}</td>
            </tr> <br><br><br>

            
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Marca: {{$v->marca}} </td>
                <td style="border: 1px solid black;">Modelo: {{$v->modelo}}</td>
                <td style="border: 1px solid black;">Matíricula:{{$v->matricula}}</td>
            </tr>

            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Nº Chassi: {{$v->numero_chassi}} </td>
                <td style="border: 1px solid black;">Caixa Velocidade:{{$v->tipo_caixavelocidade}}</td>
                <td style="border: 1px solid black;">Nº Motor: {{$v->num_motor}}</td>
              
            </tr>


            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Data fabrico: {{$v->data_fabrico}} </td>
                <td style="border: 1px solid black;">Tipo Combustivel:{{$v->tipo_combustivel}}</td>
                <td style="border: 1px solid black;">Cor: {{$v->cor}}</td>
            </tr>

            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Tipo aquisição: {{$v->tipoaquisicao_desc}}</td>
                <td style="border: 1px solid black;">Departamento Benficiario:{{$v->departamentos}}</td>
                <td style="border: 1px solid black;">Custo aquisição kz:{{number_format($v->custo_aquisicao_kz, 2,",",".")}}</td>
            </tr>

            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">Custo aquisição USD: {{number_format($v->custo_aquisicao_usd, 2,",",".")}}</td>
                <td style="border: 1px solid black;">Custo aquisição EURO: {{number_format($v->custo_aquisicao_euro, 2,",",".")}}</td>
                <td style="border: 1px solid black;"></td>
            </tr><br>

            <tr style="border: 1px solid black;">
              <div style="padding:0 auto">INFORMAÇÕES DO SEGURO</div>
                
            </tr><br>
           
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">Seguradora: {{$v->nome_segurador}}</td>
                <td style="border: 1px solid black;">Apólice: {{$v->apolice}}</td>
                <td style="border: 1px solid black;">Cobertura: {{$v->cobertura}}</</td>
            </tr>

            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">Valor do seguro: {{number_format($v->valor_seguro, 2,",",".")}}</td>
                <td style="border: 1px solid black;">data início: {{$v->data_inicio}}</td>
                <td style="border: 1px solid black;">data fim: {{$v->data_fim}}</td>
            </tr>
        </table>

         
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
         <p style="text-align: center">Documento processado pelo computador. Data Emissão: {{date('y-m-d')}}</p>
         <p style="text-align: center">Emitido por: {{Auth::user()->name}}</p>

    </div>
    
</body>
</html>