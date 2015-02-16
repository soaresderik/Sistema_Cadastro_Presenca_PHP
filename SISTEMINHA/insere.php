<?php
	require_once('conexao.php');
	
	$qtd = $_GET['qtd'];
	//$flag=0;// flag pra mensagem lá no final do script
	

	//---------------------   PARTE 1  ----------------------------------//
	
	if(isset($_GET['opcao'])){ /// neste IF recebo o vetor de checkbox HTML
		$flag=1;
		for($i=0;$i<count($_GET['opcao']);$i++){
			if($_GET['opcao'][$i]!=null){
			
				//echo "<br>".$_GET['opcao'][$i];
			
				$array = $_GET['opcao'];
			}
		}
						
		/*for($i=0;$i<count($_GET['opcao']);$i++){ // este laço serve para verificar os valores que vieram do... 
												  // do checkbox
												  
			echo "<br>" .$array[$i] ." "; /// mostrar o array com os valores vindos do checkBox HTML
		}*/
		
		


		//---------------------   PARTE 2  ----------------------------------//
		
		 /*

			 Neste Trecho pensei em uma lógica para tornar dinamico as presenças
			 fazendo um vetor receber os valores entre os intervalos de alunos 
			 por exemplo 3 alunos - 3 aulas então ficaria um array que vai 
			 de 1 a 3 , um array de 4 a 6 e um array de 7 a 9
			 Então depois melhorei a lógica , otimizei pra um arrayzão "pai"
			 e em cada posição dele tem outro vetor "filho" guardando cada aluno

		 */
		
		$sql = mysqli_query($conexao , "SELECT * FROM aulas"); /// aqui eu pego a quantidade de estudantes que tem na tabela
		//echo "Total de Alunos : ";
		$t = mysqli_num_rows($sql);
		$i=0;
		$a=1;
		while($t > 0){
			$a+=1;
			$i++;
			$t--;
		}
		//printf($a);
		$testa2 = $a;
		
		echo "<br>";
		$aux = 1;
		$testa=0;
		$contP=0;
		while($a > 0){
			for($i=0;$i<$qtd;$i++){
				$vet[$contP][$i] = "$aux"; /// automatizando o array pros aluno
				$aux++;	
			}
			$testa+=1;
			$contP++;
			$a--;
		}
		//print_r($vet);		


		 
		//********************** PARTE 3 *********************************//
		
		 /*
			 Neste ponto realizei busca completa pra verificar 
			 poderia usar também busca binária após ordenar com o quickSort da STL do PHP, deixando assim
			 a lógica até bem eficiente pra n alunos ( 10 mil por exemplo )
		 */

		echo"<br>";
		//echo "VETOR COM AS PRESENÇAS DE TODOS OS ALUNOS<br>";
		$gustavo=0;
		while($gustavo < $testa2-1){
			$cont[$gustavo] = 0;
			$gustavo++;
		}
		for($i=0;$i<$qtd;$i++){
			for($j=0;$j<count($_GET['opcao']);$j++){
				for($r=0;$r<$testa2;$r++){
					if($vet[$r][$i]==$array[$j]){
						$cont[$r]++;
					}
				}
			}
		}
		//print_r($cont);
		


		// -*-*-*-*-*-*-*-*-*-*-*-*-*-* PARTE 4 -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*//

		echo"<br><br>";
		$trem=0;
		$repeticao = 0;
		//echo "Posições do Array para pegar a frequencia dos alunos<br>";
		//for($repeticao=0;$repeticao<count($cont);){ 

			$sql = "SELECT * from aulas";
			$query2 = mysqli_query($conexao,$sql);
			while($sql = mysqli_fetch_array($query2)){
				echo $cont[$repeticao] . " ";
				$value = $cont[$repeticao]; //quantas aulas tem que ir
				
					$id = $sql["id"];
					$query = "update aulas set frequencia = frequencia + $value where id='$id'";
					$resultado = mysqli_query($conexao , $query);
					//echo $sql['id'];
					$repeticao++;
			}
			
		//}
		
	}

	mysqli_close($conexao);
	
	/*if($flag==1)
	echo "<h1>FREQUENCIA INSERIDA COM SUCESSO</h1><br>";
	
	else if($flag==0)
	echo "<h1>SEM AULAS!!!</h1><br>";
	
	echo"<br><a href='info.php'>Voltar</a> <br>";*/
	
	header('location:info.php');

?>