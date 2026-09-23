<?php


class Piloto
{
    protected $nome;
    protected $escuderia;
    protected $velocidadeBase;
    protected $pontosCampeonato = 0;
    protected $corridasDisputadas = 0;
    protected $vitorias = 0;

    function __construct($nome, $escuderia, $velocidadeBase)
    {
        $this->nome = $nome;
        $this->escuderia = $escuderia;
        $this->velocidadeBase = $velocidadeBase;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getPontos()
    {
        return $this->pontosCampeonato;
    }

    function adicionarPontos($pontos)
    {
        $this->pontosCampeonato += $pontos;
        $this->corridasDisputadas++;

        if ($pontos >= 25) {
            $this->vitorias++;
        }
    }

    function simular()
    {
        $desempenho = $this->velocidadeBase + (mt_rand(-30, 30) / 10);
        
        return array("desempenho" => $desempenho, "status" => "completou a prova");
    }

    function getTipo()
    {
        return "Piloto";
    }

    function exibirFicha()
    {
        return $this->nome . " | " .
            $this->escuderia . " | " .
            $this->getTipo() . " | Velocidade: " .
            $this->velocidadeBase . " | Pontos: " .
            $this->pontosCampeonato . " | Corridas: " .
            $this->corridasDisputadas . " | Vitorias: " .
            $this->vitorias;
    }
}
