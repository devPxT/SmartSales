<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-estoquista.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>

    <?php require "geral/links.php" ?>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body id="estoque">

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

                    $sql = "SELECT t1.id, t1.cor, t1.tamanho, t1.quantidade, t1.data_cad, t1.produto_id FROM estoque t1 WHERE id = $id";

                    if ($result = $conn->query($sql)) {   // Consulta ao BD ok
                        if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
                            $row = $result->fetch_assoc();
    
                            $cor = $row['cor'];
                            $tamanho = $row['tamanho'];
                            $quantidade = $row['quantidade'];

                            $produto = $row['produto_id'];
    
                            // Obtém as Especialidades Médicas na Base de Dados para um combo box
                            $sqlG = "SELECT id, nome FROM produto";
                            $result = $conn->query($sqlG);
                            $optionsProdutos = array();
    
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = "";
                                    if ($row['id'] == $produto)
                                        $selected = "selected";
                                    array_push($optionsProdutos, "\t\t\t<option . $selected . value='" . $row["id"] . "'>" . $row["nome"] . "</option>\n");
                                }
                            } else {
                                echo "Erro executando SELECT: " . $conn->connect_error;
                            }
    
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do Item do Estoque a ser Atualizado</h2>
                        </div>
                        <form class="w3-container" action="estoquista-updt-estoque-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td>
                            <!-- <p> -->
                                <input class="w3-input w3-border w3-light-grey" name="id" type="hidden" min="1" step="1"
                                    value="<?php echo $id; ?>" required>
                                <!-- </p> -->
                            <p>
                                <label class="w3-text-IE"><b>Tamanho</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Tamanho" type="text" pattern="([a-zA-Z\u00C0-\u00FF ]{1,3}|[0-9]{1,2})$"
                                    title="Tamanho entre 1 e 3 letras OU entre 1 e 2 numeros." value="<?php echo $tamanho; ?>" required></p>

                            <p>
                                <label class="w3-text-IE"><b>Cor</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Cor" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{3,100}$"
                                    title="Cor entre 3 e 100 letras." value="<?php echo $cor; ?>" required></p>

                            <p>
                                <label class="w3-text-IE"><b>Quantidade</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Quantidade" type="number" min="1" value="<?php echo $quantidade; ?>" required></p>

                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
                                    value="<?php echo $data; ?>" disabled style="cursor: no-drop; background-color: lightgray !important;"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>

                            <p>
                                <label class="w3-text-IE"><b>Produto</b></label>
                                <select name="Categoria" id="Categoria" class="w3-input w3-border w3-light-grey" 
                                disabled style="cursor: no-drop; background-color: lightgray !important;" required>
                                <?php
                                    foreach($optionsProdutos as $key => $value){
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
                            <input type="submit" value="Salvar" class="btn btn-success" >
                            <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='estoquista-lst-estoque.php'">
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