<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/login.css">

    <!-- <script src="framework/jquery-3.7.1.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>

    <link rel="icon" type="image/png" href="imgs/favicon.png"/>

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
<body>
<?php
    session_start();
    if (isset($_SESSION['cargo_nome'])) {                                
        if ($_SESSION['cargo_nome'] == 'Administrador'){
            $url = 'location: /smartsales/admin-home.php';	             
            header($url);                                         	 
            exit();
        }else if ($_SESSION['cargo_nome'] != 'Administrador'){
            $url = 'location: /smartsales/home.php';	 
            header($url);                                         	  
            exit();
        }
    }

    $msg        = "";
    if(isset($_SESSION['nao_autenticado'])){ 
        // Houve falha(login incorreto ou cadastro incorreto)
        $msg        = $_SESSION['mensagem'];
        $style      = "display:block"; // div da msg aparece 
    }else{
        // Usuário já autenticado
        unset($_SESSION['nao_autenticado']);
        $style      = "display:none"; // div da msg não aparece 
    }
?>


    <div id="modalErro" class="modal" style="<?php echo $style;?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" stye="justify-content: center">
                    <h5 class="modal-title" style="color: red">ERRO</h5>
                </div>
                <div class="modal-body" style="text-align: center">
                    <p id="mensagemErro" style="margin-bottom: 0px;"><?php echo $msg; ?></p>
                    <?php 
                        session_destroy();
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="fecharModal()">OK</button>
                </div>
            </div>
        </div>
  </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">SmartSales</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(imgs/image.png);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Entrar</h3>
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
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <!-- <input type="checkbox" style="cursor: pointer;" > <span>Lembre-se de mim</span> -->
                                        <label class="checkbox-wrap checkbox-primary mb-0">Lembre-se de mim
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Esqueceu sua Senha?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        // Verifica se a sessão 'mensagem' está definida e mostra o modal se estiver
        // $(document).ready(function() {
        //     <?php if (isset($_SESSION['mensagem'])) : ?>
        //         $('#errorModal').modal('show');
        //     <?php endif; ?>
        // });
    </script>

</body>
</html>
