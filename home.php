<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <?php require "geral/links.php" ?>

    <style>
        #modalErro {
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050;
        }

        #modalErro .modal-dialog {
            margin-top: 20vh; 
        }
    </style>
</head>
<body id="home">
<?php
    $msg = "";
    if(isset($_SESSION['mensagem'])){ 
        $msg = $_SESSION['mensagem'];
        $style = "display:block"; // div da msg aparece 
    }else{
        unset($_SESSION['mensagem']);
        $style = "display:none"; // div da msg não aparece 
    }
?>

    <div id="modalErro" class="modal" style="<?php echo $style;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="justify-content: center">
                    <h5 class="modal-title" style="color: red">ERRO</h5>
                </div>
                <div class="modal-body" style="text-align: center">
                    <p id="mensagemErro" style="margin-bottom: 0px;"><?php echo $msg; ?></p>
                    <?php 
                        unset($_SESSION['mensagem']);
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="fecharModal()">OK</button>
                </div>
            </div>
        </div>
  </div>

    <?php require "geral/navbar.php" ?>
    
    <div class="container-fluid mt-3 home">
        <div class="row">
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-plus-square" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">CADASTROS</p>
                    </div>
                </div>
            </a>
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="vendedor-lst-vendas.php">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-tags" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">VENDAS</p>
                    </div>
                </div>
            </a>
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-box" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">ESTOQUE</p>
                    </div>
                </div>
            </a>
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-bar-chart" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">FATURAMENTO</p>
                    </div>
                </div>
            </a>
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="admin-home.php">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-building-gear" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">ADMINISTRAÇÃO</p>
                    </div>
                </div>
            </a>
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-person" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">PERFIL</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- <div class="container-fluid mt-3">

    <div> -->

    <?php require "geral/footer.php" ?>
</body>
</html>