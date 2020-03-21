<?php

date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

$temp = isset($_GET['temp']) ? $_GET['temp'] : null;
$humid = isset($_GET['humid']) ? $_GET['humid'] : null;
$dataHora=date('Y-m-d');//DATA ATUAL.
$dataHtml = isset($_GET['data']) ? $_GET['data'] : null;//DATA QUE É DESEJADO SER MOSTRADA.

$servername = "------";
$username = "--------";
$password = "-----";
$dbname = "bd_abelhas_cefet";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_erro) {
  //Gravar log de erros
  die("Não foi possível estabelecer conexão com o BD: " . $conn->connect_error);
} 
if(!is_null($temp) || !is_null($humid)){
$sql = "INSERT INTO `bd_abelhas_cefet`.`dados_abelhas` (temp, humid,dataHora,horario) VALUES ('$temp', '$humid','$dataHora','$dataEspecifica')"
}
if ($conn->query($sql)) {
  //Gravar log de erros
  die("Erro na gravação dos dados no BD");
}

$consulta = "SELECT temp,humid FROM `dados_abelhas` WHERE dataHora = '$dataHtml'";//GRAVANDO A DATA QUE PEGA DO INPUT
$con = $conn->query($consulta) or die($mysqli->error);

while ($row = mysqli_fetch_array($con)) {

		$temp = $temp . '"'. $row['temp'].'",';
		$humid = $humid . '"'. $row['humid'] .'",';
	}

	$temp = trim($temp,",");
	$humid = trim($humid,",");


$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jataí Cefet</title>
	<meta charset="utf-8" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styleIndex.css">
	<link rel="icon" type="imagem/png" href="imagens/ico.ico">
</head>
<body>
		<nav id="navegação">
			<ul>
				<li><a href="#inicio">Início</a></li>
				<li><a href="#dadosColetados">Dados Coletados</a></li>
				<li><a href="#conhecaJatai">Conheça as Jataí</a></li>
				<li><a href="#nos">Nós</a></li>
				<li><a href="#oProjeto">O Projeto</a></li>
			</ul>	
		</nav>

		<section id="banner">				
				<div class="conteudo">

				<h1>Jataí Cefet</h1>
				<p><strong>"O conhecimento sobre a vida dessas abelhas são de grande valia para sua preservação. Afinal, ninguém preserva o que não conhece."</strong></p>
				</div>	
		</section>
<div class="conteudoPartes">
		<section id="inicio">
			<img src="imagens/comeia.png">
			<h2>INÍCIO</h2>
				<div class="pFundoRosa">
					<p>
						No Brasil, existem mais de 192 espécies de Abelhas sem Ferrão, e elas 	têm   grande importância   para   a   polinização de quase 80% das plantas em seus biomas, por isso são muito importantes para a vida no planeta. 	Esse trabalho   é   parte   de   um   projeto   que pretende  estudar  estas  espécies,  chamar a atenção sobre sua importância e criar meios para auxiliar em sua preservação trazendo, através deste, meios e conhecimentos. 
					</p>
					<p>
						Se você quiser saber TUDO sobre como fizemos nosso projeto pode visitar a sessão:
					</p>
					<a href="#oProjeto">Clique e veja o projeto!</a>
				</div>
				<div class="pFundoBranco">
					<p>
					No campus 2 do CEFET-Mg existem muitas espécies de abelhas, tanto com ferrão quanto sem. As abelhinhas que estudamos são chamadas de Jataí, mas seu nome científico é <i>Tetragonisca angustula</i>. Nós criamos uma sessão especial para elas aqui no site:
					</p>
					<a href="#conhecaJatai">Clique e conheça as Jataí!</a>
				</div>								
		</section>

		<section id="dadosColetados">					
			<h2 style="margin-left:2%">Monitoramento Colmeia CAMPUS 2</h2>       
			<form action="/" method="GET" id="formulario" style="margin-left:1%;">
				Data: <input type="date" name="data">
			   <input type="submit" value="Mostrar" style="height: 45px;font-size: 16px;color: #e62165;padding: 12px;">
		    </form>
		<div class="container">	
				<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
	
				<script>
					var ctx = document.getElementById("chart").getContext('2d');
					var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: ['1h','2h','3h','4h','5h','6h','7h','8h','9h','10h','11h','12h','13h','14h','15h','16h','17h','18h','19h','20h','21h','22h','23h','24h'],
						datasets: 
						[{
							label: 'Temperatura',
							data: [<?php echo $temp; ?>],
							backgroundColor: 'transparent',
							borderColor:'rgba(255,99,132)',
							borderWidth: 3
						},
	
						{
							label: 'Umidade',
							data: [<?php echo $humid; ?>],
							backgroundColor: 'transparent',
							borderColor:'rgba(0,255,255)',
							borderWidth: 3	
						}]
					},
				 
					options: {
						scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
						tooltips:{mode: 'index'},
						legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
					}
				});
				</script>
			</div>
		</section>

		<section id="conhecaJatai">	
			<h2>CONHEÇA AS JATAÍ</h2>
			<h3><i>Tetragonisca angustula</i></h3>
			<div class="divSize2">
				<p>
					A Jataí é uma abelha social de ampla distribuição no Brasil. É considerada uma abelha dócil e de fácil manejo para melipoculturas(criação de abelhas sem ferrão).
					Apesar de sobreviverem em diferentes ambientes e terem grande capacidade para fazer ninhos, em caso de criação, os meliponários devem estar em um local sombreado pois elas são mais resistentes ao frio do que ao sol.
				</p>		
			</div>
			<div class="divSize2">
				<p>
					O mel dessas abelhas é conhecido em alguns lugares como "mel de anjo", graças a seu tom amarelo claro e seu sabor saboroso e suave. Além dessas qualidades ele também é bastante procurado por suas propriedades medicinais (Fortificante e Anti-inflamatório).Elas produzem cerca de 1kg de mel por ano, e apesar da produção ser mais baixa se comparada a espécies com ferrão, pode chegar a ser vendido 100x mais caro.
				</p>
			</div>
			<img class="imgMelJatai" src="imagens/melJatai.jpg">
			<div class="pFundoRosa">
				<h3><i>Lestrimelitta limao</i></h3>
				<p>
					Uma ameaça para as Jataí do Cefet são as abelhas conhecidas como Abelhas Limão, já que elas são uma espécie pilhadora, ou seja, vivem exclusivamente do saque organizado à outros ninhos.
				</p>
				<p>
					O mel das Limão é considerado tóxico e perigoso se consumido pelo homem, em razão das secreções tóxicas das glândulas mandibulares dessa abelha. Porém o sucesso no ataque às outras colônias se dá pela liberação dessas secreções, que têm um cheiro semelhante a limão e provocam a dispersão dos indivíduos da colônia hospedeira. 
				</p>
			</div>
		</section>

		<section id="nos">
			<h2>NÓS</h2>
			<p>
			    Jeziel, Luiza, Tito e Samuel - esses somos nós, (ou pelo menos como nos chamamos). Estudamos Redes de Computadores no Cefet há dois anos, mas esse ano decidimos nos juntar e fazer alguma coisa que agregasse no nosso ano letivo. Foi por isso que resolvemos nos dedicar à META. 
			</p>
			<p>
			    Pra nós, fazer parte desse projeto não é só correr atrás de meritos e prêmios, mas sim adquirir conhecimentos que nós nunca conseguiriamos somente com o curso técnico. É imensurável a quantidade de experiências que fazer um projeto como esse pode trazer, e o quanto podemos aprender com isso: desde convivência e divisão de trabalho até a criar circuitos malucos e não matar abelhas bebê tentando colocar o ESP-32 dentro da colmeia (Rs).
			</p>
			<p>
			    Nós esperamos que esse projeto só cresça, e que possamos cada vez mais compartilhar os conhecimentos que conseguirmos durante o desenvolvimento dele.
			</p>
			<div>
			  <img src="images/lu.jpg" style="width: 150px;height: 150px;background-color: #000;color: #FFF;border-radius: 50%;display: flow-root;margin-left: 26%"/>
			  <img src="images/jezi.jpg" style="width: 150px;height: 150px;background-color: #000;color: #FFF;border-radius: 50%;margin-left: 39%;margin-top: -16%;"/>
			  <img src="images/tito.jpg" style="width: 150px;height: 150px;background-color: #000;color: #FFF;border-radius: 50%;margin-left: 40%;margin-top: 5%;"/>
			  <img src="images/samu.jpg" style="width: 150px;height: 150px;background-color: #000;color: #FFF;border-radius: 50%;display: flow-root;margin-left: 26%;margin-top: -17%;/>
			 </div>
			

		</section>

		<section id="oProjeto">
			<h2>O PROJETO</h2>
			<p>
				Nosso projeto tem como objetivo desenvolver um sistema de monitoramento automático de temperatura e umidade dentro e fora das colmeias, composto por um microcontrolador ESP-32, sensor de umidade e temperatura, base de dados e site para  coleta  de dados e	consulta aos resultados.
			</p>
			<p>
				Foi utilizado um microcontrolador ESP-32 configurado para coletar dados e possibilitar o monitoramento das abelhas sem ferrão. Foram implementados, inicialmente, um sensor de temperatura e umidade e uma bateria de lítio 18650, formando uma estrutura que foi colocada em uma caixa e em seguida dentro da colmeia.
			</p>

			<p>
				As informações são coletadas e enviadas para um banco de dados, no qual são armazenadas e utilizadas por esse site ou pelo aplicativo para consulta.
				O site foi criado utilizando HTML e CSS e o aplicativo para dispositivos móveis foi desenvolvido no App Inventor do MIT. 
			</p>
			<p>
				Imagina-se como evolução deste projeto a construção de uma grande base de dados, na qual estarão registradas e acessíveis, pelo aplicativo e pelo site, a localização de várias colmeias urbanas. Dessa forma podendo realizar o controle e o monitoramento destas e evitar a perda desse rico elemento da fauna brasileira que são as abelhas sem ferrão, tendo em vista que uma das formas de se fazer isso é preservar as colônias naturais. 
			</p>

			<p>
				Esse trabalho   é   parte   de   um   projeto   que pretende  estudar  as  espécies,  chamar a atenção sobre sua importância e criar meios para auxiliar em sua preservação. Afinal, ninguém preserva o que não conhece.  
			</p>
		</section>
		<footer>
			
		</footer>
</div>
		
</body>
</html>
