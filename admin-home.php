<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    
    <?php require "geral/links.php" ?>
</head>
<body id="admin">

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

    <div class="container-fluid mt-3">
        <div class="row row-cols-1 row-cols-lg-2 g-4 me-md-5 ms-md-5">
            <a class="col" href="admin-produto.php">
                <div class="card">
                    <img src="icons/new-box.png" alt="NOVO PRODUTO">
                    <div class="card-body">
                        <p class="card-text">CADASTRO DE PRODUTO</p>
                    </div>
                </div>
            </a>
            <div class="col">
                <div class="card">
                    <img src="icons/acess.png" alt="ACESSOS">
                    <div class="card-body">
                        <p class="card-text">ACESSOS</p>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <?php require "geral/footer.php" ?>
</body>
</html>
