<?php
include('./php/conexao.php'); //incluei a conexão do banco
$sql = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador"; //select com os nomes dos jogadores e quantidade de vitorias, derrotas e empates somados.
$resultado = mysqli_query($conn, $sql); //faz a conexão com o banco e traz a consulta do banco

$parametro = filter_input(INPUT_GET, "parametro"); //adiciona o que foi inserido pelo usuario na variavel
$parametrofiltro = filter_input(INPUT_GET, "parametros"); //adiciona o que foi inserido pelo usuario na variavel

$select_filtro = "
select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from bd_jogodavelha.jogador where nome_jogador like '%$parametro%'"; //select com o nome digitado pelo usuario e quantidade de vitorias, derrotas e empates somados.

$select_vencedor_maior = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador order by vitoria_jogador desc;"; //select com os nomes dos jogadores e quantidade de vitorias em ordem decrescente.
$select_vencedor_menor = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador order by vitoria_jogador asc;"; //select com os nomes dos jogadores e quantidade de vitorias em ordem crescente.

$select_empate_maior = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador order by empate_jogador desc;"; //select com os nomes dos jogadores e quantidade de empates em ordem decrescente.
$select_empate_menor = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador order by empate_jogador asc;"; //select com os nomes dos jogadores e quantidade de empates em ordem crescente.

$select_derrota_maior = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador order by derrota_jogador desc;"; //select com os nomes dos jogadores e quantidade de derrotas em ordem decrescente.
$select_derrota_menor = "select nome_jogador,sum(vitoria_jogador) as 'vitoria_jogador',sum(derrota_jogador) as 'derrota_jogador',sum(empate_jogador) as 'empate_jogador' from jogador group by nome_jogador order by derrota_jogador asc;"; //select com os nomes dos jogadores e quantidade de derrotas em ordem crescente.

if($parametro){ //se a variavel $parametro estiver preenchida faz a consulta com o select
	$resultado = mysqli_query($conn, $select_filtro);
}

if($parametrofiltro  == 2){ //se a variavel $parametrofiltro é igual a 2 faz consulta com o select
	$resultado = mysqli_query($conn, $select_vencedor_maior);
}

if($parametrofiltro  == 3){ //se a variavel $parametrofiltro é igual a 3 faz consulta com o select
	$resultado = mysqli_query($conn, $select_vencedor_menor);
}
if($parametrofiltro  == 4){ //se a variavel $parametrofiltro é igual a 4 faz consulta com o select
	$resultado = mysqli_query($conn, $select_empate_maior);
}
if($parametrofiltro  == 5){ //se a variavel $parametrofiltro é igual a 5 faz consulta com o select
	$resultado = mysqli_query($conn, $select_empate_menor);
}
if($parametrofiltro  == 6){ //se a variavel $parametrofiltro é igual a 6 faz consulta com o select
	$resultado = mysqli_query($conn, $select_derrota_maior);
}
if($parametrofiltro  == 7){ //se a variavel $parametrofiltro é igual a 7 faz consulta com o select
	$resultado = mysqli_query($conn, $select_derrota_menor);
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Jogo da Velha</title>
	<link rel="stylesheet" href="./css/jogos.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="fundo">
   <div class="titulo">
  <H1> Jogo da Velha</H1>
</div>
<!--  Div centro centraliza os objetos no meio da tela -->
	<div class="centro">
            <!-- Formulario das informações dos jogadores Nome,Vitoria,Derrota,Empate.  -->
		<form action="./php/jogo.php" method="POST">
      <!-- Estrutura dos campos do Jogador 1 -->
			<p class="centro">
				<label class="texto" for="player1"> Jogador 1: </label>
				<input class="afastabotão" name="player1" id="jogador1" type="text" placeholder="Digite seu nome... ">
				<!-- Os campos abaixo são ocultos na tela HTML servem como coleta dos dados JS para enviar para banco -->
				<input id="1vitoria" class="afastabotão" name="vitorias1" type="hidden" value="" placeholder="Vitorias">
				<input id="1derrota" class="afastabotão" name="derrotas1" type="hidden" value="" placeholder="Derrotas">
				<input id="1empate" class="afastabotão" name="empate1" type="hidden" value="" placeholder="Empate">
			</p>
			<!-- Fim da estrutura de jogador 1 -->
			
			<!-- Estrutura dos campos do Jogador 2 -->
			<p class="centro">
				<label class="texto" for="player2"> Jogador 2: </label>
				<input class="afastabotão" name="player2" id="jogador2" type="text"  placeholder="Digite seu nome...">

			<!-- Os campos abaixo são ocultos na tela HTML servem como coleta dos dados JS para enviar para banco -->
				<input id="2vitoria" class="afastabotão" name="vitorias2" type="hidden" value="" placeholder="Vitorias">
				<input id="2derrota" class="afastabotão" name="derrotas2" type="hidden" value="" placeholder="Derrotas">
				<input id="2empate" class="afastabotão" name="empate2" type="hidden" value="" placeholder="Empate">

			</p>
			<div class="centro">
				<!-- Botões de ação do formulario e do jogo -->
				<!-- O botão salvar envia os dados do formulario para o pagina .php,
				ele so ficara disponivel para ser clicado apos o termino da partida,
				para bloquear o botão foi utilizado o disable e sua reativação e feita atraves do JS -->
				<!-- Evitando que os dados sejão salvos de maneira incorreta-->
				<button class="btn btn-success button" type="submit" id="salvar" disabled="true"> Salvar Jogo</button>
				<!-- O botão Iniciar Jogo e o unico botão disponivel a primeiro momento para ser clickado -->
				<button class="btn btn-primary button" type="button" onclick="iniciar()" id="iniciarr">Iniciar Jogo</button>
				<button class="btn btn-danger button" type="button" onclick="limpar()" id="limparr" disabled="true">Limpar tabuleiro</button>
			</div>
			<!-- Fim da estutura de jogador 2-->
		</form>



	</div>
	<div id="mostrador">
		<p class="texto" style="float: left; margin-right: 10px;">Vez do Jogador:</p>
		<img src=""  height="50">
	</div>

	<!-- criação do tabuleiro -->
	<div class="tabuleiro">
		<div id="a1" class="espaco" jogada=""></div>
		<div id="a2" class="espaco" jogada=""></div>
		<div id="a3" class="espaco" jogada=""></div>

		<div id="b1" class="espaco" jogada=""></div>
		<div id="b2" class="espaco" jogada=""></div>
		<div id="b3" class="espaco" jogada=""></div>

		<div id="c1" class="espaco" jogada=""></div>
		<div id="c2" class="espaco" jogada=""></div>
		<div id="c3" class="espaco" jogada=""></div>

	</div>

	<script type="text/javascript" src="./js/jogo.js"></script>
	
  <P>
	  <h1 class="texto tabela afastar_top">Tabela de Ranking</h1>
  </P>
	<div class="tabela ">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>"> <!-- faz referencia a propia pagina para retorna requisição -->
			<label class="texto" for="pesquisar">Filtrar Jogador</label>
			<input class="afastabotão" id="pesquisa" type="text" name="parametro"> <!-- campo para digitar qual jogador a ser procurado -->
			<input class="btn btn-primary button" type="submit" value="Buscar"> <!-- botão para realizar a busca -->
		</form>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>"> <!-- faz referencia a propia pagina para retorna requisição -->
			
			<!-- Criação das opções para os filtros, cada opção tem um value que serve para identificar qual filtro selecionado -->
			<select class="afastabotão" name="parametros" id=""  >
				<option value="" name="" selected >Filtros.....</option>
				<option value="2" name="parametro2">Maior Vitoria</option>
				<option value="3" name="parametro3">Menor Vitoria</option>
				<option value="4" name="parametro4">Maior Empate</option>
				<option value="5" name="parametro5">Menor Empate</option>
				<option value="6" name="parametro4">Maior Derrota</option>
				<option value="7" name="parametro5">Menor Derrota</option>
				<input class="btn btn-primary button" type="submit" value="Buscar">
			</select>
			
		</form>

		
	</div>

	<!-- Criação da tabela de ranking -->
	<div class="tabela">
		<table class="tab" border="10">
				<tr align="center">
					<!-- Criação das colunas -->
					<td class="centro2 texto">Nome</td> 
					<td class="centro2 texto">Vitoria</td>
					<td class="centro2 texto">Derrota</td>
					<td class="centro2 texto">Empate</td>
				</tr>

				<?php  while($dado = $resultado -> fetch_array()){ //enquanto houver algum tipo de dado os campos serão preenchidos e exibidos ?>

				<tr align="center">
					<td><?php echo $dado['nome_jogador']; //insere o dado de acordo coma a coluna do banco ?></td>
					<td><?php echo $dado['vitoria_jogador']; //insere o dado de acordo coma a coluna do banco ?></td>
					<td><?php echo $dado['derrota_jogador']; //insere o dado de acordo coma a coluna do banco ?></td>
					<td><?php echo $dado['empate_jogador']; //insere o dado de acordo coma a coluna do banco ?></td>
				</tr>

				<?php }?>
			</table>
	</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>	
</html>