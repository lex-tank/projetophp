<?php
include 'sessao.php';
// Se já foi incluído, o arquivo não será chamado novamente
require_once 'config.php';
 
$nome = $cargo = $salario = "";
$nome_erro = $cargo_erro = $salario_erro = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validando o nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_erro = "Digite o nome do funcionário";
    } elseif(!filter_var(trim($_POST["nome"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nome_erro = 'Por favor, corrija e utilize um nome válido';
    } else{
        $nome = $input_nome;
    }
    
    // Validando cargo
    $input_cargo = trim($_POST["cargo"]);
    if(empty($input_cargo)){
        $cargo_erro = 'Qual o cargo do funcionário?';     
    } else{
        $cargo = $input_cargo;
    }
    
    // Validando salario
    $input_salario = trim($_POST["salario"]);
    if(empty($input_salario)){
        $salario_erro = "Qual o salário do funcionário?";     
    } elseif(!ctype_digit($input_salario)){
        $salario_erro = 'Please enter a positive integer value.';
    } else{
        $salario = $input_salario;
    }
    
    // Verifica os erros antes de inserir no banco
    if(empty($nome_erro) && empty($cargo_erro) && empty($salario_erro)){
        // SQL pra inserir na tabela
        $sql = "INSERT INTO funcionarios (nome, cargo, salario) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conexao, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_nome, $param_cargo, $param_salario);
            
            $param_nome = $nome;
            $param_cargo = $cargo;
            $param_salario = $salario;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Ocorreu algo errado! Por favor, tente novamente mais tarde.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($conexao);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criando Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
		input[type=text] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 3px solid #555;
			background-color: lightblue;
		}
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
                        <h2>Criando Registro</h2>
                    </div>
                    <p>Por favor, preencha o formulário e envie para adicionar o registro do funcionário ao banco de dados.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_erro)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_erro;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cargo_erro)) ? 'has-error' : ''; ?>">
                            <label>Cargo</label>
                            <input type="text" name="cargo" class="form-control" value="<?php echo $cargo; ?>">
                            <span class="help-block"><?php echo $cargo_erro;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salario_erro)) ? 'has-error' : ''; ?>">
                            <label>Salario</label>
                            <input type="text" name="salario" class="form-control" value="<?php echo $salario; ?>">
                            <span class="help-block"><?php echo $salario_erro;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>