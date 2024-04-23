<!DOCTYPE html>
<html>
	<head>
      <?php require "login/verifica-login-admin.php" ?>

	  <title>Administração</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">

      <?php require "geral/links.php" ?>

	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
<body id="admin">
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
                $cpf = $_POST['CPF'];

                $nome    = $_POST['Nome'];
                $data    = $_POST['Data'];
                $cargo = $_POST['Cargo'];
                // $email = $_POST['Email'];
                $data_cad = $_POST['DataCad'];

                $login = $_POST['Login'];
                $senha  = $_POST['Senha'];

                $md5Senha = md5($senha);
                
                // Cria conexão
                $conn = new mysqli($servername, $username, $password, $database);

                // Verifica conexão 
                if ($conn->connect_error) {
                    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                }
                ?>

                <div class='w3-responsive w3-card-4'>
                <div class="w3-container w3-theme">
                <h2>Inclusão de Novo Funcionário</h2>
                </div>

                <?php
                $sql = "SELECT id FROM funcionario WHERE cpf = '$cpf'";

                //verifica se deu erro ou não no comando do sql
                if ($result = $conn->query($sql)) {

                    //verifica se o select tem mais alguma linha, se tiver linha significa que funcionario ja existe
                    if ($result -> num_rows > 0) {
                        echo "<p>&nbsp;Erro cadastrando funcionario. CPF já existente! </p>";
                        echo "</div>";
                        echo "</div>";

                    } else {
                        // $sql2 = "INSERT INTO funcionario (nome, dt_nasc, cpf, login, senha, cargo_id, email) VALUES ('$nome','$data', '$cpf', '$login', '$md5Senha', $cargo, '$email')";
                        $sql2 = "INSERT INTO funcionario (nome, dt_nasc, cpf, login, senha, cargo_id, data_cad) VALUES ('$nome','$data', '$cpf', '$login', '$md5Senha', $cargo, '$data_cad')";

                        //verifica se deu erro no insert do funcionario
                        if ($result2 = $conn->query($sql2)) {
                            echo "<p>&nbsp;Funcionário cadastrado com sucesso! </p>";
                            echo "</div>";
                        } else {
                            echo "<p>&nbsp;Erro executando INSERT: " .  $conn->connect_error . "</p>";
                        }
                        echo "</div>";
                        $conn->close(); //Encerra conexao com o BD

                    }

                } else{
                    echo "<p style='text-align:center'>Erro selecionando ID do funcioario: " . $conn-> error . "</p>";
                }

            ?>
        </div>

        <div class="col-lg-1 col-sm-2 col-12">
            <button type="button" class="btn btn-primary mb-3" onclick="window.location.href='admin-lst-funcionario.php'" style="width: 100%">Voltar</button>
        </div>
        
    </div>

    <?php require "geral/footer.php" ?>

</body>
</html>