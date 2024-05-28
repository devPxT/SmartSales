<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-estoquista.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoquista</title>
    
    <?php require "geral/links.php" ?>
</head>
<body id="estoque">

    <style>
        .card-body {
            text-align: center;
        }
        .card {
            align-items: center;
        }
        .card img {
            max-width: 450px;
            /* margin: auto; */
        }
    </style>

    <?php require "geral/navbar.php" ?>

    <div class="container-fluid mt-3 home">
        <div class="row row-cols-1 row-cols-lg-2 g-4 me-md-5 ms-md-5">
            <a class="col" href="estoquista-lst-estoque.php">
                <div class="card">
                    <i class="bi bi-box" style="font-size: 300px; margin: auto"></i>
                    <div class="card-body">
                        <p class="card-text">ESTOQUE DE PRODUTOS</p>
                    </div>
                </div>
            </a>
            <a class="col" href="" onclick="dev(event)">
                <div class="card">
                    <i class="bi bi-truck" style="font-size: 300px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">ENTREGAS</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php require "geral/footer.php" ?>
</body>
</html>
