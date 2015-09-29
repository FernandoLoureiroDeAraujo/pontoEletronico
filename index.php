<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" /> 
    <title> Controle de funcionários </title>
  </head>
  <body>    
    <div class="box">
      <center>
       <form id="form" name="form" action="" method="post">
        <b><label>Controle de funcionários</label></b>
        <input type="text" name="lblcpf" id="lblcpf" placeholder="Digite seu CPF" size ="40" maxlength="11"/>
        <button type="submit" class="btn">Enviar</button>
      </form>
      </center>
    </div>
  </body>
</html>

<?php
 if(isset($_POST['lblcpf'])){
  include ('insert.php');
 }
?>

