<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <link href="css/styleRelatorio.css" rel="stylesheet" type="text/css" /> 
    <title> Relatório de funcionários </title>
  </head>
  <body>    
    <div class="box">
    <center>
      <form id="form" name="form" action="" method="post">
        <label>Relatório de funcionários</label>
        <input type="text" name="lblsearch" id="lblsearch" placeholder="Digite o CPF do funcionário" size ="40" maxlength="11"/>
        <input type="submit" value="enviar"></br>
      </form>
    </center>
    </div>
  </body>
</html>

<?php
 if(isset($_POST['lblsearch'])){
  include ('select.php');
 }
?>
