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

    <div class="container-fluid mt-3 home">
        <div class="row row-cols-1 row-cols-lg-2 g-4 me-md-5 ms-md-5">
            <a class="col" href="admin-lst-categoria.php">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-grid" style="font-size: 300px;"></i>
                        <p class="card-text">CATEGORIAS</p>
                    </div>
                </div>
            </a>
            <a class="col" href="admin-lst-produto.php">
                <div class="card">
                    <div class="card-body">
                        <i class="bi bi-box-seam" style="font-size: 300px;"></i>
                        <p class="card-text">PRODUTOS</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php require "geral/footer.php" ?>
</body>
</html>
