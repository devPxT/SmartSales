<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <?php require "geral/links.php" ?>

</head>
<body id="home">
    <script>
        <?php
            $msg = "";
            if(isset($_SESSION['mensagem'])){ 
                $msg = $_SESSION['mensagem'];
                
        ?>
                Swal.fire({
                    icon: "error",
                    title: "Erro",
                    text: "<?php echo $msg; ?>"
                    <?php 
                        unset($_SESSION['mensagem']);
                    ?>
                });
        <?php
            } else {
                unset($_SESSION['mensagem']);
            }
        ?>
    </script>
    


    <?php require "geral/navbar.php" ?>
    
    <div class="container-fluid mt-3 home">
        <div class="row">
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="vendedor-cadastros-home.php">
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
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="estoquista-lst-estoque.php">
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