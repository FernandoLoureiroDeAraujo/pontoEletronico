<?php
	date_default_timezone_set('America/Sao_Paulo');
	include('conect.php');
	$cpf = $_POST["lblcpf"];

	$data = date('Y-m-d');
	$hora = date('H:i:s');

	// Verifica se o cpf passado existe, se existir entra no big if.
	$select = mysql_query("SELECT * FROM tbl_dadosFuncionario WHERE Func_CPF ='$cpf'");
	$line = mysql_num_rows($select);

	// Big if.
	if($line > 0) {
		// Seleciona a data de hoje de acordo com o cpf, para fazer algumas verificações depois.
		$select1 = "SELECT Func_CPF, Entrada1, Saida1, Entrada2, Saida2, Data FROM tbl_registroFuncionario WHERE Func_CPF = '$cpf' AND Data = '$data'";
		$result1 = mysql_query($select1) or die (mysql_error());
		$line1 = mysql_num_rows($result1);

		while($line1=mysql_fetch_array($result1)){
			$entrada1 = $line1['Entrada1'];
			$saida1 = $line1['Saida1'];
			$entrada2 = $line1['Entrada2'];
			$saida2 = $line1['Saida2'];
		}

		// Faz verificação se os seguintes campos são nulos, se for executa o bloco. Se não vai passando para o proximo, ate a vida acabar.
		if($entrada1 == null || $entrada1 == " "){
			$sql = "INSERT INTO tbl_registroFuncionario (Cod_rf, Entrada1, Saida1, Entrada2, Saida2, Data, Func_CPF) 
		    		VALUES (null,'$hora', null, null, null, '$data', '$cpf')";
		    $resultado = mysql_query($sql) or die (mysql_error());

		    echo "<script> alert(' Ponto realizado com sucesso!, Entrada 1') </script>";
		    echo "<script>location.href='index.php'</script>";
		} else {
			if($saida1 == null || $saida1 == " "){
				$sql = ("UPDATE tbl_registroFuncionario SET Saida1 = '$hora' WHERE Func_CPF = '$cpf' AND Data = '$data'");
				$resultado = mysql_query($sql) or die (mysql_error());

			    echo "<script> alert(' Ponto realizado com sucesso!, Saida 1') </script>";
			    echo "<script>location.href='index.php'</script>";
			} else {
				if ($entrada2 == null || $entrada2 == " ") {
					$sql = ("UPDATE tbl_registroFuncionario SET Entrada2 = '$hora' WHERE Func_CPF = '$cpf' AND Data = '$data'");
					$resultado = mysql_query($sql) or die (mysql_error());

				    echo "<script> alert(' Ponto realizado com sucesso!, Entrada 2') </script>";
				    echo "<script>location.href='index.php'</script>";
				} else {
					if($saida2 == null || $saida2 == " "){
						
						// Realiza a subtração entre horario de entrada e saida. Informa horas trabalhadas.
						$entrada1 = DateTime::createFromFormat('H:i:s', $entrada1);
						$saida1 = DateTime::createFromFormat('H:i:s', $saida1);
						$saida1 = $entrada1->diff($saida1);
						$saida1 = $saida1->format('%H:%I:%S');

						$hora2 = $hora;
						$entrada2 = DateTime::createFromFormat('H:i:s', $entrada2);
						$hora2 = DateTime::createFromFormat('H:i:s', $hora2);
						$saida2 = $entrada2->diff($hora2);
						$saida2 = $saida2->format('%H:%I:%S');

						// Realiza soma dos dois horarios.						
						$data1 = new DateTime('00:00:00');						
						$total = new DateTime('00:00:00');
						$dataSoma1 = new DateTime($saida1);
						$dataSoma2 = new DateTime($saida2);
						$total->add($data1->diff($dataSoma1));
						$total->add($data1->diff($dataSoma2));
						$totalHoras = $data1->diff($total)->format('%H:%I:%S');
						//$totalHoras = '10:23:50';

						if ($totalHoras < '08:00:00') {
							// Deficit
							$horas8 = '08:00:00';
							$extra = DateTime::createFromFormat('H:i:s', $totalHoras);
							$horas8 = DateTime::createFromFormat('H:i:s', $horas8);
							$HorasDeficit = $extra->diff($horas8);
							$HorasDeficit = $HorasDeficit->format('%H:%I:%S');
						} else {
							// Extra
							$horas8 = '08:00:00';
							$extra = DateTime::createFromFormat('H:i:s', $totalHoras);
							$horas8 = DateTime::createFromFormat('H:i:s', $horas8);
							$HorasExtra = $extra->diff($horas8);
							$HorasExtra = $HorasExtra->format('%H:%I:%S');
						}

						$sql = ("UPDATE tbl_registroFuncionario SET Saida2 = '$hora', TotalHoras = '$totalHoras', HorasExtra = '$HorasExtra', HorasDeficit = '$HorasDeficit' 
								 WHERE Func_CPF = '$cpf' AND Data = '$data'");
						$resultado = mysql_query($sql) or die (mysql_error());

					    echo "<script> alert(' Ponto realizado com sucesso!, Saida 2 ') </script>";
					    echo "<script>location.href='index.php'</script>";
					} else {
			    		echo "<script> alert(' Você excedeu o nº de batida do dia') </script>";				    
					    echo "<script>location.href='index.php'</script>";
					}
				}
			}
		}
	} else {
	 	echo "<script> alert('Funcionario não encontrado') </script>";
		echo "<script>location.href='index.php'</script>";
	}
?>