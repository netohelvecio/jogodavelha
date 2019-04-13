/* @author Equipe: Andrew Lima, Fernanda Porto, Helvécio Neto, Maicon Rodrigues e Paulo Reis.
 * @version 2.0 
 * jogo.js, 10/04/2019
 * Todos os direitos reservados para Andrew Lima, Fernanda Porto, Helvécio Neto, Maicon Rodrigues e Paulo Reis da Equipe de Desenvolvimento de Sistemas/SENAI-CETIND
 * Orientador: David Sodré
 * Prova de Valor 10 pontos DV.SISTEMAS 2 TEMA: JOGO DA VELHA Com cadastro de jogadores e listagem por vencedor,perdedor,empates.
 * Funções do Script
	*	
 	* Iniciar()
	* Limpar()
	* atualizaMostrador()
	* inicializarEspacos()
	* verificarresultado()
	* exibirResultado()
	* preloadImages()
	*
*/
  
const player1 = "X"; //Variavel que aloca o simbolo do jogador 1 @padrao constante.
const player2 = "O"; //Variavel que aloca o simbolo do jogador 2 @padrao constante.
var playTime = player1; //Variavel que determina a vez do jogador 1 ou 2 @padrão jogador 1 inicia.
var gameOver = true; //Variavel que determina se o jogo esta em processo ou não.
var images = new Array();//Variavel do tipo Array que aloca as imagens no tabuleiro. 
var jogador1 = ""; //Variavel que guarda o nome do primeiro jogador @vazio.
var jogador2 = ""; //Variavel que guarda o nome do segundo jogador @vazio.
var vitoria1 = 0; //Variavel que guarda a vitoria do jogador 1 @padrao 
var vitoria2 = 0; //Variavel que guarda a vitoria do jogador 2 @padrao 
var derrota1 = 0; //Variavel que guarda a derrota do jogador 1 @padrao 
var derrota2 = 0; //Variavel que guarda a derrota do jogador 2 @padrao 
var empate1 = 0; //Variavel que guarda a empate do jogador 1 @padrao 
var empate2 = 0; //Variavel que guarda a empate do jogador 2 @padrao 


/*Função: responsavel por iniciar o jogo da velha.
* Restrição: é obrigatorio passar os nomes dos 2 jogadores, caso não estiver preenchido é exibido um alert.
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: retorna os nomes dos 2 jogadores
*/
function iniciar() { // função que e chamada no html com o @button (Iniciar jogo), @method (onClick). 
	jogador1 = document.getElementById('jogador1').value; //captura o valor da @inputText(jogador1) e armazena localmente. 
	jogador2 = document.getElementById('jogador2').value; //captura o valor da @inputText(jogador2) e armazena localmente. 
     
	if (jogador1 == "") { // Verifica se os campo (jogador1) esta preenchido.
		gameOver = true;// Não inicia o jogo se o campo jogador1 estiver @vazio. 
		alert('Informe o nome dos jogador 1 !!');//@alert Informa que o campo esta @vazio.
	} else if (jogador2 == "") { // Verifica se o campo (jogador2) esta preenchido.
		gameOver = true;// Não inicia o jogo se o campo jogador2 estiver @vazio. 
		alert('Informe o nome dos jogador 2 !!'); //@alert Informa que o campo esta @vazio. 
	}
	else {
		gameOver = false;//se tudo estiver preenchido @gameOver recebe (false) e o jogo inicia.
		alert(jogador1 + "    VS    " + jogador2);// @alert Informa o nome dos jogadores salvos localmente. 
	}
	
}

/*Função: responsavel por dá um refresh na página
* Restrição: botão de limpar tela é bloqueado enquanto jogo não é iniciado.
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: vazio
*/
function limpar() { // a função limpar e chamada pelo @Button (Limpar tabuleiro) @method (onClick) que atualiza a pagina.
	location.href = "index.php";// Endereço da pagina principal. 
}


preloadImages("imagens/x.png", "imagens/o.png") //@function faz o pré-carregamento do local das imagens que seram alocas no @array.
atualizaMostrador();// @function atuliza a imagen/figura do indicador da vez do jogador. 
inicializarEspacos();// @function carrega os espaços do tabuleiro para o Click. 


/*Função: responsavel por carregas as imagens utilizadas no jogo.
* Restrição: nennhum.
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: vazio
*/
function preloadImages() {//@function carregamento das imagens. 
	for (i = 0; i < preloadImages.arguments.length; i++) {
		images[i] = new Image()
		images[i].src = preloadImages.arguments[i]
	}
}

/*Função: responsavel por verificar quem joga e atribui o simbolo ao jogador.
* Restrição: nenhuma.
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: se a variavel gameOver é igual a true retorna vazio identificando que o jogo não começou 
*/
function atualizaMostrador() { //@function atuliza o campo do mostrador.

	if (gameOver) { return; }// @GamerOver = True quer dizer que jogo não inico por tanto o mostrador não retorna nada.  

	if (playTime == player1) {//@playTime Verifica a vez do jogador e atribui o simbolo. 

		var player = document.querySelectorAll("div#mostrador img")[0];
		player.setAttribute("src", images[0].src);
	} else {//@playTime Verifica a vez do jogador e atribui o simbolo. 

		var player = document.querySelectorAll("div#mostrador img")[0];
		player.setAttribute("src", images[1].src);
	}
}

/*Função: responsavel por inserir a imagem no campo selecionado pelo jogador e faz o controle de quem é a vez.
* Restrição: não é possivel escolher o campo que já esta preenchido.
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: se a variavel gameOver é igual a true retorna vazio identificando que o jogo não começou 
*/
function inicializarEspacos() {//Ativa o evento(Click) nos campos do tabuleiro. 

	var espacos = document.getElementsByClassName("espaco");//Faz a leitura dos @Class (espacos) no HTML e insere na variavel @espacos. 

	for (var i = 0; i < espacos.length; i++) {

		espacos[i].innerHTML = "<img id='p1' src='" + images[0].src + "' border='0'><img id='p2' src='" + images[1].src + "' border='0'>";
		espacos[i].getElementsByTagName('img')[0].style.display = "none";
		espacos[i].getElementsByTagName('img')[1].style.display = "none";

		espacos[i].addEventListener("click", function () {

			if (gameOver) { return; }



			if (this.getAttribute("jogada") == "") { //Faz a leitura do campo se for @vazio ele inicializa o IF.

				if (playTime == player1) { //@PlayTime se a vez for do jogador 1, adiciona o elemento imagem no campo selecionado. 
					this.getElementsByTagName('img')[0].style.display = "inline";
					this.setAttribute("jogada", player1);
					playTime = player2;//apos efetuar a jogada, muda o @playTime para o jogador2. 

				} else {//@PlayTime adiciona o elemento imagem no campo selecionado. 
					this.getElementsByTagName('img')[1].style.display = "inline";
					this.setAttribute("jogada", player2);
					playTime = player1;//apos efetuar a jogada, muda o @playTime para o jogador1. 
				}
				atualizaMostrador();//@function chama a função para atulizar o indicador. 
				verificarresultado();//@function Faz a verificação do resultado do jogo a cada elemento novo introduzido nos campos. 
			}

		});
	}
}


/*Função: responsavel por verificar os campos e declarar um vencedor, 
* se os campos estiverem todos preenchidos e no final não ter um vencedor é considerado empate.
* Restrição: algum resultado final tem que ser estabelecido(Vencedor ou Empate).
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: nenhum
*/
async function verificarresultado() {

   //Captura os elementos para verificação. 
	var a1 = document.getElementById("a1").getAttribute("jogada");
	var a2 = document.getElementById("a2").getAttribute("jogada");
	var a3 = document.getElementById("a3").getAttribute("jogada");

	var b1 = document.getElementById("b1").getAttribute("jogada");
	var b2 = document.getElementById("b2").getAttribute("jogada");
	var b3 = document.getElementById("b3").getAttribute("jogada");

	var c1 = document.getElementById("c1").getAttribute("jogada");
	var c2 = document.getElementById("c2").getAttribute("jogada");
	var c3 = document.getElementById("c3").getAttribute("jogada");

	//Faz a verificação a cada jogada de todos os campos e procura de um resultado vencedor. 
	if (((a1 == b1 && a1 == c1) || (a1 == a2 && a1 == a3) || (a1 == b2 && a1 == c3)) && a1 != "") {
		resultado = a1;
	} else if ((b2 == b1 && b2 == b3 && b2 != "") || (b2 == a2 && b2 == c2 && b2 != "") || (b2 == a3 && b2 == c1 && b2 != "")) {
		resultado = b2;

	} else if (((c3 == c2 && c3 == c1) || (c3 == a3 && c3 == b3)) && c3 != "") {
		resultado = c3;
	} else if (
		//Se todos os campos forem preenchidos e não haver um vencedor automaticamente ele define o resultado como empate. 
		(a1 != "" && a2 != "" && a3 != "" && b1 != "" && b2 != "" && b3 != "" && c1 != "" && c2 != "" && c3 != "")
	) {
		resultado = "VELHA!!";//Atribui o valor a variavel @resultado (velha),
	}

	if (resultado != "") {// exibe o resultado se ele for diferente de vazio. 
		gameOver = true;// encerra o jogo. 
		await sleep(10);// gera um atraso para exibir @alert, para processamento da pagina html. 
		exibirResultado();//@function exibe o resultado. 
	}
}

/*Função: responsavel por fazer um time para exibir o alert.
* Restrição: obrigatorio passar o parametro de ms.
* @autor: Equipe Geral
* @paramatros: ms any - valor em milisegundos que o alert ficará sendo exibido.
* @return: nenhum 
*/
function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

/*Função: responsavel por declarar o vencedor, o derrotado ou empate se houver. Adiciona a derrota, vitoria ou empate no
* jogador de acordo com resultado.
* Restrição: um resultado deve ser exibido, seja vitoria ou derrota.
* @autor: Equipe Geral
* @paramatros: nenhum
* @return: retorna um alert informando o vencedor ou se o resultado foi empate. 
*/
function exibirResultado() {//@function que exibe o resultado. 

	if (resultado == "X") {//Verifica o valor da @variavel (resultado).
	
		alert("O vencedor e: " + jogador1 + "'"); //@alert informa que o vencedor e jogador1. 
		vitoria1++; //incrementa uma vitoria no jogador 1
		derrota2++; //incrementa uma derrota no jogador 2
	} else if (resultado == "O") {
		
		alert("O vencedor e: " + jogador2 + "'");//@alert informa que o vencedor e jogador2. 
		vitoria2++; //incrementa uma vitoria no jogador 2
		derrota1++; //incrementa uma derrota no jogador 1
	} else if (resultado == "VELHA!!") {
		
		alert(resultado); //@alert informa que o resultado foi empate
		empate1++; //incrementa um empate no jogador 1
		empate2++; //incrementa um empate no jogador 2
	}


	//Manda as informações para a o @formulario HTML
	document.getElementById('1vitoria').value = vitoria1;
	document.getElementById('1derrota').value = derrota1;
	document.getElementById('1empate').value = empate1;


	document.getElementById('2vitoria').value = vitoria2;
	document.getElementById('2derrota').value = derrota2;
	document.getElementById('2empate').value = empate2;

	document.getElementById('salvar').disabled = false; //reativa o botão de salvar os dados do jogo.
	document.getElementById('limparr').disabled = false;//reativa o botão de limpar a tela. 
	document.getElementById('iniciarr').disabled = true;//bloqueia o botão de salvar jogo para que não inicie outro jogo sem salvar ou limpar o tabuleiro. 
	alert('Para salvar o resultado Click no botão (Salvar Jogo)! ou (Limpar Tabuleiro) Para descartar o jogo!');//@alert informa como salvar o resultado. 
}