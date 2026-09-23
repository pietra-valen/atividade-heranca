<?php

require_once("Piloto.php");

class Campeonato
{
    private $grid = array();
    private $tabelaPontos = array(25, 18, 15, 12, 10, 8, 6, 4, 2, 1);
    private $corridaAtual = 0;

    function cadastrarPiloto($piloto)
    {
        $this->grid[] = $piloto;
    }

    function listarPilotos()
    {
        if (count($this->grid) == 0) {
            echo "Nenhum piloto cadastrado ainda.\n";
            return;
        }

        echo "------------------------------------------------------------\n";

        for ($i = 0; $i < count($this->grid); $i++) {
            echo ($i + 1) . ". " . $this->grid[$i]->exibirFicha() . "\n";
        }

        echo "------------------------------------------------------------\n";
    }

    function removerPiloto($indice)
    {
        if ($indice < 0 || $indice >= count($this->grid)) {
            return false;
        }

        array_splice($this->grid, $indice, 1);
        return true;
    }

    function simularCorrida($circuito)
    {
        if (count($this->grid) < 2) {
            echo "É preciso pelo menos 2 pilotos cadastrados!\n";
            return;
        }

        $this->corridaAtual++;

        echo "\n LARGADA! GP de " . $circuito . " - Corrida " . $this->corridaAtual . "\n\n";

        $resultados = array();

        for ($i = 0; $i < count($this->grid); $i++) {

            $piloto = $this->grid[$i];

            $resultado = $piloto->simular();

            $resultados[] = array(

                "piloto" => $piloto,
                "desempenho" => $resultado["desempenho"],
                "status" => $resultado["status"]

            );
        }

        for ($i = 0; $i < count($resultados) - 1; $i++) {

            for ($j = $i + 1; $j < count($resultados); $j++) {

                if ($resultados[$j]["desempenho"] > $resultados[$i]["desempenho"]) {

                    $temp = $resultados[$i];
                    $resultados[$i] = $resultados[$j];
                    $resultados[$j] = $temp;

                }
            }
        }

        $posicao = 1;

        for ($i = 0; $i < count($resultados); $i++) {

            $piloto = $resultados[$i]["piloto"];
            $desempenho = $resultados[$i]["desempenho"];
            $status = $resultados[$i]["status"];

            if ($desempenho <= 0) {

                echo "- " . $piloto->getNome() . " - " . $status . "\n";
                continue;
                
            }

            $pontos = 0;

            if ($posicao <= count($this->tabelaPontos)) {
                $pontos = $this->tabelaPontos[$posicao - 1];
            }

            $piloto->adicionarPontos($pontos);

            echo $posicao . " lugar - " . $piloto->getNome() .
                " (+" . $pontos . " pontos) - " . $status . "\n";

            $posicao++;
        }

        echo "\n";
    }

    function exibirClassificacao()
    {
        if (count($this->grid) == 0) {
            echo "Nenhum piloto cadastrado.\n";
            return;
        }

        $ordenado = $this->grid;

        // Organiza pelo número de pontos.
        for ($i = 0; $i < count($ordenado) - 1; $i++) {
            for ($j = $i + 1; $j < count($ordenado); $j++) {
                if ($ordenado[$j]->getPontos() > $ordenado[$i]->getPontos()) {
                    $temp = $ordenado[$i];
                    $ordenado[$i] = $ordenado[$j];
                    $ordenado[$j] = $temp;
                }
            }
        }

        echo "\n=== CLASSIFICAÇÃO DO CAMPEONATO ===\n";

        for ($i = 0; $i < count($ordenado); $i++) {
            echo ($i + 1) . " lugar - " . $ordenado[$i]->exibirFicha() . "\n";
        }

        echo "\n";
    }
}
