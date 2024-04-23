<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-admin.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>

    <?php require "geral/links.php" ?>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body id="admin">

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
                    $data = date("d/m/Y H:i:s", time());
                    echo "<p class='w3-small' > ";
                    echo "Acesso em: ";
                    echo $data;
                    echo "</p> "
                    ?>
                    <!-- Acesso ao BD-->
                    <?php
                    
                    // Cria conexão
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Verifica conexão 
                    if ($conn->connect_error) {
                        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                    }

                    $id = $_GET['id'];

                    $sql = "SELECT t1.nome, t1.dt_nasc, t1.cpf, t1.login, t1.cargo_id, t1.data_cad, t1.data_updt FROM funcionario t1 WHERE t1.id = $id";

                    if ($result = $conn->query($sql)) {   // Consulta ao BD ok
                        if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
                            $row = $result->fetch_assoc();
    
                            $nome = $row['nome'];
                            $data  = $row['dt_nasc'];
                            $cpf = $row['cpf'];
                            $login = $row['login'];
                            $cargo = $row['cargo_id'];

                            $data_cad = $row['data_cad'];
    
                            // Obtém as Especialidades Médicas na Base de Dados para um combo box
                            $sqlG = "SELECT id, nome FROM cargo WHERE id <> 1";
                            $result = $conn->query($sqlG);
                            $optionsCargo = array();
    
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = "";
                                    if ($row['id'] == $cargo)
                                        $selected = "selected";
                                    array_push($optionsCargo, "\t\t\t<option . $selected . value='" . $row["id"] . "'>" . $row["nome"] . "</option>\n");
                                }
                            } else {
                                echo "Erro executando SELECT: " . $conn->connect_error;
                            }
    
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do Funcionário a ser Atualizado</h2>
                        </div>
                        <form class="w3-container" action="admin-updt-funcionario-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td>
                            <!-- <p> -->
                                <input class="w3-input w3-border w3-light-grey" name="id" type="hidden" value="<?php echo $id; ?>" required>
                                <!-- </p> -->
                            <p>
                                <label class="w3-text-IE"><b>Nome</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{5,100}$"
                                    value="<?php echo $nome; ?>"
                                    title="Nome entre 5 e 100 letras." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Login</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Login" type="text" 
                                    pattern="[a-zA-Z]{2,20}\.[a-zA-Z]{2,20}" placeholder="nome.sobrenome" title="nome.sobrenome"
                                    value="<?php echo $login; ?>" required></p>
                            <p>
                                <label class="w3-text-IE"><b>CPF</b>*</label>
                                <input class="w3-input w3-border w3-light-grey"
                                    name="CPF" id="CPF" type="text" title="CPF do funcionario (123.456.789-10)." placeholder="123.456.789-10" 
                                    value="<?php echo $cpf; ?>" disabled style="cursor: no-drop; background-color: lightgray !important;" required></p>
                            <p>
                                <label class="w3-text-IE"><b>Data de Nascimento</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
                                    value="<?php echo $data; ?>" placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>
                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="DataCad" type="date"
                                    value="<?php echo $data_cad; ?>" disabled style="cursor: no-drop; background-color: lightgray !important;"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>
                            <p>
                                <label class="w3-text-IE"><b>Cargo</b>*</label>
                                <select name="Cargo" id="Cargo" class="w3-input w3-border w3-light-grey" required>
                                <?php
                                    foreach($optionsCargo as $key => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                            </p>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                            <p>
                            <input type="submit" value="Salvar" class="w3-btn w3-theme" >
                            <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='admin-lst-funcionario.php'">
                            </p>
                            </td>
                        </tr>
                        </table>	
                        </form>
                        <br>
                    <?php
                    } else { ?>
                        <div class="w3-container w3-theme">
							<h2>Funcionário inexistente</h2>
						    </div>
						<br>
                        <?php
					}
                } else {					
                    echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn-> error . "</p>";
                }
                echo "</div>"; //Fim form
				$conn->close(); //Encerra conexao com o BD
				?>
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