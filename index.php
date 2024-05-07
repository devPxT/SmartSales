<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/login.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- sweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="js/script.js"></script>

    <link rel="icon" type="image/png" href="imgs/favicon.png"/>

    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: white; justify-content: center">
    <script>
        <?php
            session_start();
            $msg = "";
            if(isset($_SESSION['nao_autenticado'])){
                $msg = $_SESSION['mensagem'];
                
        ?>
                Swal.fire({
                    icon: "error",
                    title: "Erro",
                    text: "<?php echo $msg; ?>"
                    <?php
                        session_destroy();
                    ?>
                });
        <?php
            } else {
                unset($_SESSION['nao_autenticado']);
                unset($_SESSION['mensagem']);

                if (isset($_SESSION['cargo_nome'])) {                                
                    if ($_SESSION['cargo_nome'] == 'Administrador'){
                        $url = 'location: /smartsales/admin-home.php';	             
                        header($url);                                         	 
                        exit();
                    } else if ($_SESSION['cargo_nome'] != 'Administrador'){
                        $url = 'location: /smartsales/home.php';	 
                        header($url);                                         	  
                        exit();
                    }
                }
            }
        ?>
    </script>

    <section class="ftco-section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(imgs/image.png);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3 class="heading-section">SmartSales</h3>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-3">Entrar</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="https://www.instagram.com/kauagabriel2608/" target="_blank" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a>
                                        <a href="https://github.com/devPxT" target="_blank" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-github"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="login/login.php" method="POST" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Login</label>
                                    <input type="text" class="form-control" placeholder="nome.sobrenome" name="usuario" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Senha</label>
                                    <input type="password" class="form-control" placeholder="sua senha" name="senha" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Entrar</button>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">
                                            Lembre-se de mim
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-right">
                                        <a href="#">Esqueceu sua senha?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
