<?php

function count_char($string, $char) {
    $qtd_char = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == $char) {
            $qtd_char++;
        }
    }
    return $qtd_char;
}

/* Tempo inicial de tarifacao */

function cadencia($cadencia) {
    $qtd_mais = count_char($cadencia, '+');

    $array = explode('+', $cadencia);
    for ($i = 0; $i < count($array); $i++) {
        $array[$i] = intval($array[$i]);
    }
    if ($qtd_mais == 2) {
        return $array;
    } else {
        return array_merge([3], $array);
    }
}

function calc_tarifa($tarifa, $duracao, $cadencia) {
    # Calcula tempo inicial
    $cadencia = cadencia($cadencia);

    # Se duração for menor que tempo inicial de cobrança, netão tarifa é zerada.
    if ($duracao <= $cadencia[0]) {
        return 0.0;
    } else {
        try {
            # Primeiro custo 
            $aux = 60 / $cadencia[1];
            $custo1 = $tarifa / $aux;

            # Retira cadencia minimo da duração total;
            $duracao_restante = $duracao - $cadencia[1];

            # Custo por incremento
            $fracao_custo = $custo1 / ((60 - $cadencia[1]) / $cadencia[2]);

            # Calcula custo 2
            $custo2 = (ceil($duracao_restante / $cadencia[2])) * $fracao_custo;
        } catch (DivisionByZeroError $e) {
            return 0.0;
        }
        #Atualiza custo total
        return $custo1 + $custo2;
    }
}

function custo_total(Array $array_db1) {
    if (is_array($array_db1) ) {
        $total = 0.0;
        foreach ($array_db1 as $item) {
            $total += calc_tarifa(floatval($item['tarifa']), intval($item['duracao']), $item['cadencia']);
        }
        return $total;
    } else {
        exit("Houve um erro.");
    }
}
