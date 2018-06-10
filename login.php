<?php
    if (isset($_POST['submit'])){
    //inclui o arquivo de conexao com o banco
      include("config.php");
      
      $username=$_POST['username'];
      $password=$_POST['password'];
      $consulta = "SELECT username FROM usuario WHERE username='$username' and password='$password'";
      $executar_consulta = $conexao->query($consulta);
	  //Se o usuario e senha existirem no banco, o valor retorna diferente de zero!
      if ($executar_consulta->fetch_assoc() != 0){
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location:index.php");
      }else{
        echo "<script type='text/javascript'>alert('Usuário ou senha inválida. Caso não esteja cadastrado entre em contato com o ADMIN!')</script>";
      }
      $conexao->close();
    }
  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RH ADM</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style media="screen">
      html,
      body {
        height: 100%;
      }

      body {
		background-image: url(imagens/foto2.png);
		background-repeat: no-repeat;
		-moz-background-size: 100% 100%;
		-webkit-background-size: 100% 100%;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
      }

      .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
      }
      .form-signin .checkbox {
        font-weight: 400;
      }
      .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>
</head>
<body >
  <link href="signin.css" rel="stylesheet">
  <form method="post" class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <label for="username" class="sr-only">Usuário</label>
      <input id="username" name="username" type="text" class="form-control" placeholder="Usuário" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input id="password" name="password" type="password" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Login">Login</button>
  </form>

  
</body>
</html>