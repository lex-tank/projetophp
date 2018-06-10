<?php
include 'sessao.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ERRO</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Solicitação inválida</h1>
                    </div>
                    <div class="alert alert-danger fade in">
                        <p>Desculpe, você solicitou algo inválido. Por favor <a href="index.php" class="alert-link">volte</a> e tente novamente.</p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>