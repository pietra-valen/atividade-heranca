<?php

require_once("PilotoTitular.php");

class PilotoLenda extends PilotoTitular
{
    private $apelido;

    function __construct($nome, $escuderia, $velocidadeBase, $anosExperiencia, $apelido)
    {
        parent::__construct($nome, $escuderia, $velocidadeBase, $anosExperiencia);
        $this->apelido = $apelido;
    }

    function getTipo()
    {
        return "Lenda";
    }

    function simular()
    {
        $resultado = parent::simular();

        if ($resultado["desempenho"] > 0) {
            $resultado["desempenho"] += 3;
        }

        return $resultado;
    }
}
