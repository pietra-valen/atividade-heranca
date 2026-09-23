<?php

require_once("modelo/Campeonato.php");
require_once("modelo/PilotoLenda.php");
require_once("modelo/PilotoTitular.php");
require_once("modelo/PilotoNovato.php");
require_once("modelo/Piloto.php");

function lerLinha($pergunta)
{
    echo $pergunta;
    return trim(fgets(STDIN));
}

function lerInteiro($pergunta)
{
    while (true) {
        $valor = lerLinha($pergunta);

        if (is_numeric($valor)) {
            return (int)$valor;
        }

        echo "Digite um número válido.\n";
    }
}

function lerFloat($pergunta)
{
    while (true) {
        $valor = lerLinha($pergunta);

        if (is_numeric($valor)) {
            return (float)$valor;
        }

        echo "Digite um número válido.\n";
    }
}

$campeonato = new Campeonato();

$campeonato->cadastrarPiloto(new PilotoLenda("Ayrton Senna", "McLaren", 92, 12, "O Mágico"));
$campeonato->cadastrarPiloto(new PilotoTitular("Max Verstappen", "Red Bull Racing", 95, 8));
$campeonato->cadastrarPiloto(new PilotoTitular("Lewis Hamilton", "Ferrari", 91, 15));
$campeonato->cadastrarPiloto(new PilotoNovato("Kimi Antonelli", "McLaren", 88, 6));
$campeonato->cadastrarPiloto(new PilotoNovato("Gabriel Bortoletto", "Audi", 82, 9));

echo "======================================\n";
echo "     SIMULADOR DE CAMPEONATO F1      \n";
echo "======================================\n";

$rodando = true;

while ($rodando) {
    echo "\n----- MENU -----\n";
    echo "1 - Cadastrar novo piloto\n";
    echo "2 - Listar pilotos\n";
    echo "3 - Simular corrida\n";
    echo "4 - Ver classificação\n";
    echo "5 - Remover piloto\n";
    echo "0 - Sair\n";

    $opcao = lerLinha("Escolha uma opção: ");

    switch ($opcao) {

        case 1:

            echo "\nTipo de piloto:\n";
            echo "1 - Titular\n";
            echo "2 - Novato\n";
            echo "3 - Lenda\n";

            $tipo = lerLinha("Escolha o tipo: ");
            $nome = lerLinha("Nome do piloto: ");
            $escuderia = lerLinha("Escuderia: ");
            $velocidade = lerFloat("Velocidade base: ");

            if ($tipo == "1") {

                $anos = lerInteiro("Anos de experiência: ");
                $campeonato->cadastrarPiloto(new PilotoTitular($nome, $escuderia, $velocidade, $anos));

            } elseif ($tipo == "2") {

                $pressao = lerInteiro("Nível de pressão psicológica: ");
                $campeonato->cadastrarPiloto(new PilotoNovato($nome, $escuderia, $velocidade, $pressao));

            } elseif ($tipo == "3") {

                $anos = lerInteiro("Anos de experiência: ");
                $apelido = lerLinha("Apelido: ");
                $campeonato->cadastrarPiloto(new PilotoLenda($nome, $escuderia, $velocidade, $anos, $apelido));

            } else {

                echo "Tipo inválido.\n";
                break;
            }

            echo "Piloto cadastrado com sucesso!\n";
            break;

        case 2:
            $campeonato->listarPilotos();
            break;

        case 3:

            $circuito = lerLinha("Nome do circuito: ");
            $campeonato->simularCorrida($circuito);
            break;

        case 4:
            $campeonato->exibirClassificacao();
            break;

        case 5:

            $campeonato->listarPilotos();
            $numero = lerInteiro("Número do piloto a remover: ");
            $indice = $numero - 1;

            if ($campeonato->removerPiloto($indice)) {

                echo "Piloto removido.\n";

            } else {

                echo "Número inválido.\n";
            }
            break;

        case 0:
            
            echo "Encerrando... Até a próxima corrida!\n";
            $rodando = false;
            break;

        default:
            echo "Opção inválida.\n";
    }
}
