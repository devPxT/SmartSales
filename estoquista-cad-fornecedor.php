<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-estoquista.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastros</title>

    <?php require "geral/links.php" ?>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body id="cadastro">
    <style>
        #admin .container-fluid .row .btn {
            width: 100%
        }
        #admin .container-fluid .row {
            justify-content: normal;
        }
    </style>

    <?php require "geral/navbar.php"; ?>
    
    <?php require 'bd/connection.php'; ?>

    <div class="w3-main w3-container" style="flex: 1;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <!-- h1 class="w3-xxlarge">Contratação de Professor</h1 -->
            <p class="w3-large">
                <div class="w3-code cssHigh notranslate">
                    <!-- Acesso em:-->
                    <?php

                    date_default_timezone_set("America/Sao_Paulo");
                    $data = date("d/m/Y H:i:s", time());
                    echo "<p class='w3-small' > ";
                    echo "Acesso em: ";
                    echo $data;
                    echo "</p> "
                    ?>
                    <!-- Acesso ao BD-->

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do novo Fornecedor</h2>
                        </div>
                        <form class="w3-container" action="estoquista-cad-fornecedor-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <!-- <td style="width:50%;"> -->
                            <td>
                                <p>
                                    <label class="w3-text-IE"><b>Nome</b>*</label>
                                    <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{1,100}$"
                                        title="Nome entre 1 e 100 letras." required></p>

                                <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <p>
                                    <input type="submit" value="Salvar" class="btn btn-success" >
                                    <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='estoquista-lst-fornecedor.php'">
                                </p>
                            </td>
                        </tr>
                        </table>	
                        </form>
                        <br>
                    </div>
                </div>
            </p>
        </div>

	<!-- FIM PRINCIPAL -->
	</div>

    <?php require "geral/footer.php" ?>

</body>
</html>