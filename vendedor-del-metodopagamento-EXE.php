<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-vendedor.php" ?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastros</title>

    <?php require "geral/links.php" ?>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body id="cadastro">

    <?php require "geral/navbar.php"; ?>
    
    <?php require 'bd/connection.php'; ?>

    <div class="w3-main w3-container" style="flex: 1">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey" >
            <!-- h1 class="w3-xxlarge">Contratação de Professor</h1 -->
            <p class="w3-large">
                <div class="w3-code cssHigh notranslate">
                    <!-- Acesso em:-->
                    <?php

                        date_default_timezone_set("America/Sao_Paulo");
                        $data = date("d/m/Y H:i:s",time());
                        echo "<p class='w3-small' > ";
                        echo "Acesso em: ";
                        echo $data;
                        echo "</p> "
                    ?>
                        <div class="w3-container w3-theme">
                            <h2>Exclusão de Método de Pagamento</h2>
                        </div>

                        <!-- Acesso ao BD-->
                    <?php
                                    
                        // Cria conexão
                        $conn = mysqli_connect($servername, $username, $password, $database);

                        // ID do registro a ser excluído
                        $id = $_POST['id'];

                        // Verifica conexão
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Faz SELECT na Base de Dados para ver se tem produto pendurado nessa marca
                        $sql = "SELECT id FROM metodopagamento WHERE id = $id";
                        //verifica se deu erro ou não no comando do sql
                        if ($result = $conn->query($sql)) {
                            //verifica se o select tem mais alguma linha, se tiver linha significa que produto ja existe
                            if ($result -> num_rows > 0) {
                                $sql = "DELETE FROM metodopagamento WHERE id = $id";

                                echo "<div class='w3-responsive w3-card-4'>";
                                if ($result = mysqli_query($conn, $sql)) {
                                    $sql2 = "DELETE FROM metodopagamento WHERE id = $id";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        echo "<p>&nbsp;Registro excluído com sucesso! </p>";
                                    } else {
                                        echo "<p>&nbsp;Erro executando DELETE DO MÉTODO DE PAGAMENTO: " . $conn -> error. "</p>";
                                    }
                                } else {
                                    echo "<p>&nbsp;Erro executando DELETE DO MÉTODO DE PAGAMENTO: " . $conn -> error. "</p>";
                                }

                            } else {
                                $sql = "DELETE FROM metodopagamento WHERE id = $id";

                                echo "<div class='w3-responsive w3-card-4'>";
                                if ($result = mysqli_query($conn, $sql)) {
                                    echo "<p>&nbsp;Registro excluído com sucesso! </p>";
                                } else {
                                    echo "<p>&nbsp;Erro executando DELETE: " . $conn -> error. "</p>";
                                }
                            }                        

                        } else {
                            echo "<p>&nbsp;Erro executando SELECT DO MÉTODO DE PAGAMENTO: " . $conn -> error. "</p>";
                        }
                        echo "</div>";
                        $conn->close();

                    ?>
                    <br>
                </div>
            </p>
        </div>
        <div class="col-lg-1 col-sm-2 col-12">
            <button type="button" class="btn btn-secondary mb-3 w-100" onclick="window.location.href='vendedor-lst-metodopagamento.php'">Voltar</button>
        </div>

	<!-- FIM PRINCIPAL -->
	</div>

    <?php require "geral/footer.php" ?>

</body>
</html>