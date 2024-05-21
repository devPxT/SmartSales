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

                    $sql = "SELECT t1.id, t1.nome, t1.descricao, t1.data_cad FROM metodopagamento t1 WHERE id = $id";

                    if ($result = $conn->query($sql)) {   // Consulta ao BD ok
                        if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
                            $row = $result->fetch_assoc();
    
                            $nome = $row['nome'];
                            $descricao = $row['descricao'];
                            $data = $row['data_cad'];
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do Método de Pagamento a ser Atualizado</h2>
                        </div>
                        <form class="w3-container" action="vendedor-updt-metodopagamento-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td>
                                <input class="w3-input w3-border w3-light-grey" name="id" type="hidden" min="1" step="1"
                                    value="<?php echo $id; ?>" title="Código do produto." required>

                            <p>
                                <label class="w3-text-IE"><b>Nome</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{5,100}$"
                                    value="<?php echo $nome; ?>"
                                    title="Método de pagamento entre 1 e 100 letras." required></p>

                            <p>
                                <label class="w3-text-IE"><b>Descrição</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Descrição" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{1,1000}$"
                                    value="<?php echo $descricao; ?>"
                                    title="Descrição de 1 até 1000 letras." required></p>

                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
                                    value="<?php echo $data; ?>" disabled style="cursor: no-drop; background-color: lightgray !important;"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                            <p>
                            <input type="submit" value="Salvar" class="btn btn-success" >
                            <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='vendedor-lst-metodopagamento.php'">
                            </p>
                            </td>
                        </tr>
                        </table>	
                        </form>
                        <br>
                    <?php
                    } else { ?>
                        <div class="w3-container w3-theme">
							<h2>Método de Pagamento inexistente</h2>
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