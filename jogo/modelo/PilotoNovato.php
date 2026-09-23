<?php

require_once ("Piloto.php");

class PilotoNovato extends Piloto
{
    private $pressaoPsicologica;

    function __construct($nome, $escuderia, $velocidadeBase, $pressaoPsicologica)
    {
        parent::__construct($nome, $escuderia, $velocidadeBase);
        $this->pressaoPsicologica = $pressaoPsicologica;
    }

    function getTipo()
    {
        return "Novato";
    }

    function simular()
    {
        $variacao = mt_rand(-50, 80) / 10;
        $desempenho = $this->velocidadeBase + $variacao;

        $chanceErro = 5 + $this->pressaoPsicologica;

        if (mt_rand(1, 100) <= $chanceErro) {

            return array("desempenho" => 0, "status" => "BATEU NA CURVA");
        }

        return array("desempenho" => $desempenho, "status" => "completou a prova");
    }
}
