<?php

require_once 'PilotoTitular.php';


class PilotoLenda extends PilotoTitular
{
    private $apelido;

    function __construct($nome, $escuderia, $velocidadeBase, $anosExperiencia, $apelido)
    {

        $this->nome = $nome;
        $this->escuderia = $escuderia;
        $this->velocidadeBase = $velocidadeBase;
        $this->anosExperiencia = $anosExperiencia;
        $this->apelido = $apelido;
    }

    function getTipo()
    {
        return "Lenda";
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

        $desempenho += 3;

        return array("desempenho" => $desempenho, "status" => "completou a prova");
    }
}
