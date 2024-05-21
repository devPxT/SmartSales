<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-vendedor.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedor</title>
    
    <?php require "geral/links.php" ?>
</head>
<body id="cadastro">

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
            <a class="col" href="vendedor-lst-clientes.php">
                <div class="card">
                    <i class="bi bi-person-add" style="font-size: 300px; margin: auto"></i>
                    <div class="card-body">
                        <p class="card-text">CLIENTES</p>
                    </div>
                </div>
            </a>
            <a class="col" href="vendedor-lst-metodopagamento.php">
                <div class="card">
                    <i class="bi bi-tags" style="font-size: 300px; margin: auto;"></i>
                    <div class="card-body">
                        <p class="card-text">MÉTODOS DE PAGAMENTO</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php require "geral/footer.php" ?>
</body>
</html>
