<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
</style>
</head>
<body>
    <nav class="navbar navbar-expand-md bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SmartSales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SmartSales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cadastros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vendas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Estoque</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Faturamento</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-xs-4">
                <div class="button">CADASTRO</div>
            </div>
            <div class="col-lg-3 col-xs-4">
                <div class="button">VENDAS</div>
            </div>
            <div class="col-lg-3 col-xs-4">
                <div class="button">FATURAMENTO</div>
            </div>
            <div class="col-lg-3 col-xs-4">
                <div class="button">ADMINISTRAÇÃO</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>