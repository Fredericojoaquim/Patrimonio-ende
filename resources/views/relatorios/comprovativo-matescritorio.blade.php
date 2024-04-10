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
                <td style="border: 1px solid black;">COMPROVATIVO DE CADASTRO MATERIAL DE ESCRITÓRIO</td>
                @php
                    $data = new DateTime($v->created_at);
                @endphp
                <td style="border: 1px solid black;"> DATA:{{$data->format('d-m-Y')}}</td>
            </tr> <br><br><br>

            
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Nº mobilizado: {{$v->num_mobilizado}} </td>
                <td style="border: 1px solid black;">Descrição: {{$v->descricao}}</td>
                <td style="border: 1px solid black;">Tipo aquisição:{{$v->tipo_aquisicao}}</td>
            </tr>

            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Custo aquisição Kz: {{number_format($v->valor_aquisicao, 2,",",".")}} </td>
                <td style="border: 1px solid black;">Custo aquisição usd:{{number_format($v->custo_aquisicao_usd, 2,",",".")}}</td>
                <td style="border: 1px solid black;">Custo aquisição euro: {{number_format($v->custo_aquisicao_euro, 2,",",".")}}</td>
              
            </tr>


            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; ">Data aquisição: {{$v->data_aquisicao}} </td>
                <td style="border: 1px solid black;">Finalidade:{{$v->finalidade}}</td>
                <td style="border: 1px solid black;">Marca: {{$v->marca}}</td>
            </tr>

            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">Cor: {{$v->cor}}</td>
                <td style="border: 1px solid black;">Atribuído ao:{{$v->pessoal}}</td>
                <td style="border: 1px solid black;">Fornecedor:{{$v->fornecedor}}</td>
            </tr>

            <tr style="border: 1px solid black;">
                
                <td style="border: 1px solid black;">Tipo: {{$v->tipo}}</td>
                <td style="border: 1px solid black;"></td>
            </tr><br>

            
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