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
                    <?php
                    
                    // Cria conexão
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Verifica conexão 
                    if ($conn->connect_error) {
                        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                    }

                    // Faz Select na Base de Dados
                    $sqlG = "SELECT id, nome FROM produto";
                    
                    $optionsProduto = array();
                    
                    if ($result = $conn->query($sqlG)) {
                        while ($row        = $result->fetch_assoc()) {
                        array_push($optionsProduto, "\t\t\t<option value='". $row["id"]."'>".$row["nome"]."</option>\n");
                        }
                    }
                    else{
                        echo "<p style='text-align:center'>Erro executando SELECT: " . $conn-> error . "</p>";
                    }
                    $conn->close();
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do novo Item do Estoque</h2>
                        </div>
                    <form class="w3-container" action="estoquista-cad-estoque-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td>
                            <p>
                                <label class="w3-text-IE"><b>Produto</b>*</label>
                                <select name="Produto" id="Produto" class="w3-input w3-border w3-light-grey" required>
                                    <option value="">Selecione um Produto...</option>
                                <?php
                                    foreach($optionsProduto as $key => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                            </p>
                            <!-- <p>
                                <label class="w3-text-IE"><b>Tamanho</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Tamanho" type="text" pattern="([a-zA-Z\u00C0-\u00FF ]{1,3}|[0-9]{1,2})$"
                                    title="Tamanho entre 1 e 3 letras OU entre 1 e 2 numeros." required></p> -->
                            <p>
                                <label class="w3-text-IE"><b>Tamanho</b>*</label>
                                <select id="Tamanho" name="Tamanho" class="w3-input w3-border w3-light-grey" required>
                                    <!-- Options will be populated by jQuery -->
                                </select>
                            </p>

                            <p>
                                <input type="radio" id="roupas" name="tipoTamanho" value="roupas" checked>
                                <label for="roupas">Roupas</label>
                                <input type="radio" id="calcados" name="tipoTamanho" value="calcados">
                                <label for="calcados">Calçados</label>
                            </p>

                            <p>
                                <label class="w3-text-IE"><b>Cor</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Cor" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{3,100}$"
                                    title="Cor entre 3 e 100 letras." required></p>
                                    
                            <p>
                                <label class="w3-text-IE"><b>Quantidade</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Quantidade" type="number" min="0" required>
                            </p>
                            
                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="DataCad" type="date"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" required>
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
                    </div>
                </div>
            </p>
        </div>

	<!-- FIM PRINCIPAL -->
	</div>

    <?php require "geral/footer.php" ?>

</body>
</html>