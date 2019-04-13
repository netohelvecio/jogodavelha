<?php
include('conexao.php'); //incluei a conexão do banco

//captura dos campos no htlm e inseridos nas variaveis no php
$player1 = $_POST['player1'];
$vitoria1 = $_POST['vitorias1'];
$derrota1 = $_POST['derrotas1'];
$empate1 = $_POST['empate1'];

$player2 = $_POST['player2'];
$vitoria2 = $_POST['vitorias2'];
$derrota2 = $_POST['derrotas2'];
$empate2 = $_POST['empate2'];


//criação dos inserts e inseridos em uma variavel
$sql = "INSERT INTO jogador (nome_jogador, vitoria_jogador, derrota_jogador, empate_jogador) VALUES ('$player1',$vitoria1,$derrota1,$empate1)"; 
$sql2 = "INSERT INTO jogador (nome_jogador, vitoria_jogador, derrota_jogador, empate_jogador) VALUES ('$player2',$vitoria2,$derrota2,$empate2)"; 

$result1 = mysqli_query($conn, $sql2); //insere os valores no banco do jogador1
$resultado = mysqli_query($conn, $sql); //insere os valores no banco do jogador2

/*Função: responsavel por verificar se o insert foi feito com sucesso
* Restrição: nenuma
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: retorna uma mensagem positiva caso o insert foi concluido com sucesso senão tambem retorna uma mensagem informando erro ao salvar
*/
function verifique()
{
    if ($result1 = '') {
        echo 'Erro ao salvar!';
    } else {
        echo 'Salvo com Sucesso!';
    };
}

//quando inserir os dados retorna para pagina php
$url = '../index.php';
echo verifique();
echo '<META HTTP-EQUIV=Refresh CONTENT="0.75; URL=' . $url . '">';
?>