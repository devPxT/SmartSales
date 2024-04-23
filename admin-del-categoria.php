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

                    $sql = "SELECT t1.id, t1.nome, t1.data_cad, t1.data_updt FROM categoria t1 WHERE t1.id = $id";

                    if ($result = $conn->query($sql)) {   // Consulta ao BD ok
                        if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
                            $row = $result->fetch_assoc();
    
                            $nome = $row['nome'];

                            $dataN = explode('-', $row["data_cad"]);
                            $anoN = $dataN[0];
                            $mesN = $dataN[1];
                            $diaN = $dataN[2];
                            $data_cad = $diaN . '/' . $mesN . '/' . $anoN;

                            if ($row["data_updt"] == null) {
                               $data_updt = ""; 
                            } else {
                                $dataM = explode('-', $row["data_updt"]);
                                $anoM = $dataM[0];
                                $mesM = $dataM[1];
                                $diaM = $dataM[2];
                                $data_updt = $diaM . '/' . $mesM . '/' . $anoM;
                            }
                            
    
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Exclusão de Categoria Cód. [<?php echo $id ?>]</h2>
                        </div>
                        <form class="w3-container" action="admin-del-categoria-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td>
                            <!-- <p> -->
                                <input class="w3-input w3-border w3-light-grey" name="id" type="hidden" min="1" step="1" value="<?php echo $id; ?>">
                                <!-- </p> -->
                            <p>
                                <label class="w3-text-IE"><b>Nome: </b> <?php echo $nome; ?> </label></p>
                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro: </b><?php echo $data_cad; ?></label></p>
                            <p>
                                <label class="w3-text-IE"><b>Data de Atualização: </b><?php echo $data_updt; ?></label></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                            <p>
                                <input type="submit" value="Confirma exclusão?" class="w3-btn w3-theme" >
                                <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='admin-lst-categoria.php'">
                            </p>
                            </td>
                        </tr>
                        </table>	
                        </form>
                        <br>
                    <?php
                    } else { ?>
                        <div class="w3-container w3-theme">
							<h2>Produto inexistente</h2>
						    </div>
						<br>
                        <?php
					}
                } else {					
                    echo "<p style='text-align:center'>Erro executando SELECT: " . $conn-> error . "</p>";
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