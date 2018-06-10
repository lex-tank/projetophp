<?php
    include 'sessao.php';
    // Processa a remoção após uma confirmação
    if(isset($_POST["id"]) && !empty($_POST["id"])){
        // Se já foi incluído, o arquivo não será chamado novamente
        require_once 'config.php';
    
         // Deleta a id
        $sql = "DELETE FROM funcionarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($conexao, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Definindo parâmetros
        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        } else{
            echo "Opa! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
     
    // Fechando declaração
    mysqli_stmt_close($stmt);
    
    // encerrando a conexão
    mysqli_close($conexao);
} else{
    // Checando a existencia do parâmetro da id
    if(empty(trim($_GET["id"]))){
        // Se não existir, redireciona para a página de erro
        header("location: erro.php");
        exit();
    }
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
                        <h1>Deletar Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Tem certeza de que deseja excluir este registro?</p><br>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>