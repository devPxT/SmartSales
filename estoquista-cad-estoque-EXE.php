<!DOCTYPE html>
<html>
	<head>
      <?php require "login/verifica-login-estoquista.php" ?>

	  <title>Estoque</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">

      <?php require "geral/links.php" ?>

	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
<body id="estoque">
<!-- Inclui MENU.PHP  -->
    <?php require 'geral/navbar.php';?>
    <?php require 'bd/connection.php'; ?>

    <div class="w3-main w3-container" style="flex: 1;">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <p class="w3-large">
        <div class="w3-code cssHigh notranslate">
        <!-- Acesso em:-->
            <?php

            date_default_timezone_set("America/Sao_Paulo");
            $data = date("d/m/Y H:i:s",time());
            echo "<p class='w3-small' > ";
            echo "Acesso em: ";
            echo $data;
            echo "</p> ";
            ?>

            <!-- Acesso ao BD-->
            <?php
                $tamanho = $_POST['Tamanho'];
                $cor    = $_POST['Cor'];
                $data_cad = $_POST['DataCad'];

                $quantidade = $_POST['Quantidade'];
                $produto = $_POST['Produto'];

                // Cria conexão
                $conn = new mysqli($servername, $username, $password, $database);

                // Verifica conexão 
                if ($conn->connect_error) {
                    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                }

                $sql = "INSERT INTO estoque (cor, tamanho, quantidade, produto_id, data_cad) VALUES ('$cor', '$tamanho', $quantidade, $produto, '$data_cad')";

                ?>
                <div class='w3-responsive w3-card-4'>
                <div class="w3-container w3-theme">
                    <h2>Inclusão de novo Item do Estoque</h2>
                </div>
                <?php
                if ($result = $conn->query($sql)) {
                    echo "<p>&nbsp;Registro cadastrado com sucesso! </p>";
                    echo "</div>";
                } else {
                    echo "<p>&nbsp;Erro executando INSERT: " .  $conn->connect_error . "</p>";
                    echo "</div>";
                }
                echo "</div>";
                $conn->close();  //Encerra conexao com o BD

            ?>
        </div>

        <div class="col-lg-1 col-sm-2 col-12">
            <button type="button" class="btn btn-secondary mb-3 w-100" onclick="window.location.href='estoquista-lst-estoque.php'">Voltar</button>
        </div>
        
    </div>

    <?php require "geral/footer.php" ?>

</body>
</html>