<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <link href="css/styleRelatorio.css" rel="stylesheet" type="text/css" /> 
    <title> Relatório de funcionários </title>
  </head>
  <body>    

    <center>
		<?php		  	
			include ('conect.php');

			$search = $_POST["lblsearch"];

			$sql1 = "SELECT Nome, Func_CPF FROM tbl_dadosFuncionario WHERE Func_CPF = '$search'";
			$result1 = mysql_query($sql1) or die (mysql_error());

			$line = mysql_num_rows($result1);


			if($line > 0) {
				while($line1=mysql_fetch_array($result1)){
					$nome = $line1['Nome'];
					$cpf = $line1['Func_CPF'];
				}

				echo"<table>  
						<thead>
					  		<tr> 
					  			<th colspan='8' align='center'>", $nome ," - ", $cpf ,"</th>				  			
				  			</tr>

					  		<tr> 
					  			<th> Data </td>
					  			<th> Entrada 1 </th>
					  			<th> Saida 1 </th>
					  			<th> Entrada 2 </th>
					  			<th> Saida 2 </th>
					  			<th> Total de horas </th>
					  			<th> Horas extra </th>
					  			<th> Horas devendo </th>
				  			</tr>
		  			    </thead>";

				$sql2 = "SELECT * FROM tbl_registroFuncionario WHERE Func_CPF = '$search'
						 ORDER BY tbl_registroFuncionario.Data ASC";
				$result2 = mysql_query($sql2) or die (mysql_error());

				while($line2=mysql_fetch_array($result2)){
					$entrada1 = $line2['Entrada1'];
					$saida1 = $line2['Saida1'];
					$entrada2 = $line2['Entrada2'];
					$saida2 = $line2['Saida2'];
					$data = $line2['Data'];
					$totalHoras = $line2 ['TotalHoras'];
					$horasExtra = $line2['HorasExtra'];
					$horasDeficit = $line2['HorasDeficit'];

						echo "<tbody><tr> <td>", date('d/m/Y', strtotime($data)), "</td>";
						echo "<td>", $entrada1    , "</td>";
						echo "<td>", $saida1      , "</td>";
						echo "<td>", $entrada2    , "</td>";
						echo "<td>", $saida2      , "</td>";
						echo "<td>", $totalHoras  , "</td>";
						echo "<td>", $horasExtra  , "</td>";						
						echo "<td>", $horasDeficit, "</td></tr></tbody>";

				}
			} else {
			 	echo "<script> alert('Funcionário não encontrado') </script>";
				echo "<script>location.href='relatorio.php'</script>";
			}

			echo "</table>";
		?>
    </center>

  </body>
</html>