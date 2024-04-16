<!DOCTYPE html>
<html lang="en">
<head>
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

                    $sql = "SELECT t1.nome, t1.marca, t1.valor, t1.data, t1.categoria_id, t1.genero FROM produto t1 WHERE id = $id";

                    if ($result = $conn->query($sql)) {   // Consulta ao BD ok
                        if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
                            $row = $result->fetch_assoc();
    
                            $nome = $row['nome'];
                            $marca = $row['marca'];
                            $valor = $row['valor'];
                            $data  = $row['data'];
                            $genero = $row['genero'];
                            $categoria = $row['categoria_id'];
    
                            // Obtém as Especialidades Médicas na Base de Dados para um combo box
                            $sqlG = "SELECT id, nome FROM categoria";
                            $result = $conn->query($sqlG);
                            $optionsCategoria = array();
    
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = "";
                                    if ($row['id'] == $categoria)
                                        $selected = "selected";
                                    array_push($optionsCategoria, "\t\t\t<option . $selected . value='" . $row["id"] . "'>" . $row["nome"] . "</option>\n");
                                }
                            } else {
                                echo "Erro executando SELECT: " . $conn->connect_error;
                            }
    
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do Produto a ser Atualizado</h2>
                        </div>
                        <form class="w3-container" action="admin-updt-produto-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td>
                            <!-- <p> -->
                                <input class="w3-input w3-border w3-light-grey" name="id" type="hidden" min="1" step="1"
                                    value="<?php echo $id; ?>" 
                                    title="Código do produto." required>
                                <!-- </p> -->
                            <p>
                                <label class="w3-text-IE"><b>Nome</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{5,100}$"
                                    value="<?php echo $nome; ?>"
                                    title="Nome entre 5 e 100 letras." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Marca</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Marca" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{3,100}$"
                                    value="<?php echo $marca; ?>"
                                    title="Marca entre 3 e 100 letras." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Valor</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Valor" type="number" min="0" step="0.01"
                                    value="<?php echo $valor; ?>"
                                    title="Valor em reais do produto." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
                                    value="<?php echo $data; ?>" disabled style="cursor: no-drop; background-color: lightgray !important;"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>
                            <p>
                            <p>
                                <label class="w3-text-IE"><b>Categoria</b>*</label>
                                <select name="Categoria" id="Categoria" class="w3-input w3-border w3-light-grey" required>
                                    <option value=""></option>
                                <?php
                                    foreach($optionsCategoria as $key => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                            </p>
                            <p>
                                <label class="w3-text-IE"><b>Gênero</b>*</label><br>
                                <input class="w3-radio" type="radio" name="Genero" value="Masculino" <?php if($genero === 'Masculino') echo 'checked'; ?> required>
                                <label class="w3-validate">Masculino</label>

                                <input class="w3-radio" type="radio" name="Genero" value="Feminino" <?php if($genero === 'Feminino') echo 'checked'; ?> required>
                                <label class="w3-validate">Feminino</label>

                                <input class="w3-radio" type="radio" name="Genero" value="Unisex" <?php if($genero === 'Unisex') echo 'checked'; ?> required>
                                <label class="w3-validate">Unisex</label>
                            </p>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                            <p>
                            <input type="submit" value="Salvar" class="w3-btn w3-theme" >
                            <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='admin-lst-produto.php'">
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