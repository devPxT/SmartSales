<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">SmartSales</a>
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
                        <a class="nav-link" id="home" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="cadastro" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="vendedor-lst-clientes.php">Clientes</a></li>
                            <li><a class="dropdown-item" href="vendedor-lst-metodopagamento.php">Métodos de Pagamento</a></li>
                            <li><a class="dropdown-item" href="estoquista-lst-fornecedor.php">Fornecedor</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="vendas" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Vendas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="vendedor-lst-clientes.php" >Clientes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="dev(event)">Vendas</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="vendas" href="vendedor-lst-vendas.php" role="button">
                            Vendas
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="estoque" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Estoque
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="estoquista-lst-estoque.php">Estoque de Produtos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="dev(event);">Entregas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="faturamento" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Faturamento
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="dev(event);">Registro de Faturamento</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="dev(event);">Recalcular Faturamento</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="admin" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administração
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin-lst-categoria.php" >Categorias</a></li>
                            <li><a class="dropdown-item" href="admin-lst-produto.php">Produtos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="admin-lst-funcionario.php">Acessos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fcba03">
                            <?php echo $_SESSION['cargo_nome'] . ": " . $_SESSION['nome']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-danger" href="login/logout.php">Sair<i class="bi bi-x float-end"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
<!-- <script src="framework/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script> -->
<script>
    var id = $("body").attr("id");
    $(".navbar-nav #"+id).addClass("active");
</script>