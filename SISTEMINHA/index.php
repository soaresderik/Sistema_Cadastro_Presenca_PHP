<html>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Frequencia</th>
			<th>Quantidade de Aulas</th>
		</tr>
		
<?php
	require_once('conexao.php');
	if($_POST!=null){
	$aux = 0;
	$data = $_POST['data'];
	if($data!=""){
		echo "<br>A Data de hoje é : " . $data . "<br><br>";
	}else{
		echo "<br><b>Usuário não informou a data</b><br><br>";
	}
	$query = "select * from aulas";
	
	$resultado = mysqli_query($conexao , $query);
	
	while($array = mysqli_fetch_array($resultado)){
?>	
	<tr>
		<td><?php echo $array[0] ?></td>
		<td><?php echo $array[1] ?></td>
		<td><?php echo $array[2] ?></td>
		<?php $valor = $_POST['qtd']; 
		echo "<form action='insere.php' method='get'>";
		echo"<td>";
		for($i=0;$i<$valor;$i++){
			$aux++;
			$aux2 = "$i";
			echo "<input type='checkbox' name='opcao[]$aux2' value='$aux'/>";
		}
		echo "</td>";
		?>		
		</tr>
		
	<?php
		}
		
	?>
		
	</table>
		<?php  
			 $sql = mysqli_query($conexao , "SELECT * FROM aulas");
			 $t = mysqli_num_rows($sql);
			 if($t > 0){ 
			 	echo"<input type='hidden' name='qtd' id='qtd' value='$valor'/>";
			}else{
			 	$valor = 0;
			 	echo"<input type='hidden' name='qtd' id='qtd' value='$valor'/>";
		}?>
		<input type="submit" value="Enviar"/><br>
	</form>
	
	<?php
	}else{
		echo "<h1>SEM NADA PRA MOSTRAR, INSIRA DADOS</h1>";
	}
	mysqli_close($conexao);
	?>
	<a href="info.php">Voltar</a>

</html>