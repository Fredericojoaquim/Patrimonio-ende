<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateInterval;
use Carbon\Carbon;

class Helper extends Controller
{
    //

    function calcularPeriodosDepreciacao($vidaUtil, $dataInicio)
{
    $periodos = [];

    $dataInicio = new DateTime($dataInicio); // Aqui estava ocorrendo o erro

    for ($i = 1; $i <= $vidaUtil; $i++) {
        $dataFim = clone $dataInicio; // Clonamos a data de início para evitar modificar a original
        $dataFim->add(new DateInterval('P1Y'));
        $periodos[] = [
            'anuidade' => $i,
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim' => $dataFim->format('d/m/Y')
        ];
        // Atualiza a data de início para o próximo período
        $dataInicio = $dataFim;
    }

    return $periodos;
}




function calcularVidaUtilRestante($dataInicio, $vidaUtilTotal)
{
    // Converter a data de início para um objeto Carbon
    $dataInicio = Carbon::createFromFormat('Y-m-d', $dataInicio);

    // Obter a data atual
    $dataAtual = Carbon::now();

    // Calcular a vida útil decorrida
    $vidaUtilDecorrida = $dataInicio->diffInYears($dataAtual);

    // Calcular a vida útil restante
    $vidaUtilRestante = $vidaUtilTotal - $vidaUtilDecorrida;

    return $vidaUtilRestante;
}


function calcularDepreciacaoAcumuladaEValorContabil($vidaUtil, $dataInicio, $valorResidual, $depreciacaoAnual,$valorAtivo)
{
    $depreciacaoAcumulada = 0;

    // Converter a data de início para um objeto Carbon
    $dataInicio = Carbon::createFromFormat('Y-m-d', $dataInicio);

    // Obter a data atual
    $dataAtual = Carbon::now();

    // Calcular a vida útil decorrida
    $vidaUtilDecorrida = $dataInicio->diffInYears($dataAtual);

    // Limitar a vida útil decorrida ao máximo da vida útil total
    $vidaUtilDecorrida = min($vidaUtil, $vidaUtilDecorrida);

    // Calcular a depreciação acumulada
    for ($i = 0; $i < $vidaUtilDecorrida; $i++) {
        $depreciacaoAcumulada += $depreciacaoAnual;
    }

    // Calcular o valor contábil
    $valorContabil = $valorAtivo - $depreciacaoAcumulada;

    return [
        'depreciacao_acumulada' => $depreciacaoAcumulada,
        'valor_contabil' => $valorContabil
    ];
}



function verificarVidaUtilExpirada($dataInicio, $vidaUtil)
{
    $dataInicio = Carbon::createFromFormat('Y-m-d', $dataInicio);
    $dataAtual = Carbon::now();

    // Adiciona a vida útil em anos à data de início
    $dataFimVidaUtil = $dataInicio->addYears($vidaUtil);

    // Verifica se a data atual é posterior à data de término da vida útil
    return $dataAtual->greaterThanOrEqualTo($dataFimVidaUtil);
}

}
