<?php

require_once ("Piloto.php");

class PilotoTitular extends Piloto
{
    protected $anosExperiencia;

    function __construct($nome, $escuderia, $velocidadeBase, $anosExperiencia)
    {
        $this->anosExperiencia = $anosExperiencia;
    }

    function getTipo()
    {
        return "Titular";
    }

    function simular()
    {
        $experiencia = $this->anosExperiencia;

        if ($experiencia > 10) {
            $experiencia = 10;
        }

        $bonus = $experiencia * 0.3;
        $desempenho = $this->velocidadeBase + $bonus + (mt_rand(-30, 30) / 10);

        $chanceErro = 8 - $this->anosExperiencia;

        if ($chanceErro < 2) {
            $chanceErro = 2;
        }

        if (mt_rand(1, 100) <= $chanceErro) {
            return array("desempenho" => 0, "status" => "ABANDONOU (problema mecanico)");
        }

        return array("desempenho" => $desempenho, "status" => "completou a prova");
    }
}
