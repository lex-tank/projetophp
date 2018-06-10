<?php include 'sessao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>SISTEMA RH</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 720px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body style="background-image:url(imagens/bg.jpg)">
    <a href="logout.php" class="btn btn-warning btn-sm pull-right">Clique aqui para sair</a>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Dados dos Funcionários</h2>
                        <a href="criar.php" class="btn btn-primary btn-lg pull-right">Adicionar Funcionário</a>
                    </div>
                    <?php
                    // Se já foi incluído, o arquivo não será chamado novamente
                    require_once 'config.php';
                    
                    // SQL pra selecionar da tabela
                    $sql = "SELECT * FROM funcionarios";
                    if($result = mysqli_query($conexao, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Cargo</th>";
                                        echo "<th>Salário</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['cargo'] . "</td>";
                                        echo "<td>" . $row['salario'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='visualizar.php?id=". $row['id'] ."' title='Visualizar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                                            echo "<a href='atualizar.php?id=". $row['id'] ."' title='Atualizar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-edit'></span></a>";
                                            echo "<a href='remover.php?id=". $row['id'] ."' title='Deletar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-remove'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Após a consulta, libera a memória associada ao resultado
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Nenhum registro foi encontrado.</em></p>";
                        }
                    } else{
                        echo "ERRO: Não foi possível executar! $sql. " . mysqli_error($conexao);
                    }
 
                    // Fechando a connexão
                    mysqli_close($conexao);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
</html>