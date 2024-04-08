<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&display=swap" rel="stylesheet">

<style>
    .buttons {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }
    .button {
        width: 100%;
        height: 100px;
        margin: 10px;
        text-align: center;
        line-height: 100px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        cursor: pointer;
    }
    .row a {
        text-decoration: none;
    }
    .row .card:hover {
        cursor: pointer;
        background-color: #e6f4f7;
    }
    .card-body {
        margin: 0px auto;
        padding: 0px;
    }
    .card-body .card-text {
        /* font-family: "Bungee Spice", sans-serif; */
        font-weight: 900;
        font-size: 30px;
    }
    .container-fluid .row .button-container {
        display: flex;
        justify-content: center;
    }
    .container-fluid .row {
        justify-content: center;
    }
</style>
</head>
<body>
    <?php require "geral/navbar.php" ?>
    
    <div class="container-fluid mt-3">
        <div class="row">
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-plus-square" style="font-size: 150px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">CADASTROS</p>
                    </div>
                </div>
            </a>
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
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
            <a class="col-lg-4 col-md-5 col-sm-6 col-xs-12 button-container mb-4" href="#">
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

    <div class="container-fluid mt-3">

    <div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>