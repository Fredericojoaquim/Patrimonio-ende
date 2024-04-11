<?php


class Helper 
{

function calcularPeriodosDepreciacao($vidaUtil, $dataInicio)
{
    $periodos = [];

    $dataInicio = new DateTime($dataInicio);

    for ($i = 1; $i <= $vidaUtil; $i++) {
        $dataFim = $dataInicio->add(new DateInterval('P1Y'));
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



}