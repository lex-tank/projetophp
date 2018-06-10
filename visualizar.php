<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    include("sessao.php");
    // arquivo de conexão ao banco
    require_once 'config.php';
    
    $sql = "SELECT * FROM funcionarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($conexao, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $nome = $row["nome"];
                $cargo = $row["cargo"];
                $salario = $row["salario"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Opa! Alguma coisa deu errado. Tente novamente mais tarde.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($conexao);
} else{
    header("location: erro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visualizando o Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body style="background-image:url(imagens/bg.jpg)">
    <a href="logout.php" class="btn btn-warning btn-sm pull-right">Clique aqui para sair</a>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Registro do funcionário de ID</h2> 
						<p><h3>Nº <?php echo $row["id"]; ?></h3></p>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <p class="form-control-static"><?php echo $row["nome"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Cargo</label>
                        <p class="form-control-static"><?php echo $row["cargo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salário</label>
                        <p class="form-control-static"><?php echo $row["salario"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>