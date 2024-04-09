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

    <div class="w3-main w3-container" >

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
                    $sqlG = "SELECT id, nome FROM categoria";
                    
                    $optionsCategoria = array();
                    
                    if ($result = $conn->query($sqlG)) {
                        while ($row        = $result->fetch_assoc()) {
                        array_push($optionsCategoria, "\t\t\t<option value='". $row["id"]."'>".$row["nome"]."</option>\n");
                        }
                    }
                    else{
                        echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn-> error . "</p>";
                    }
                    $conn->close();
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do novo Produto</h2>
                        </div>
                        <form class="w3-container" action="admin-cad-produto-EXE.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                        <tr>
                            <td style="width:50%;">
                            <p>
                                <label class="w3-text-IE"><b>Nome</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{5,100}$"
                                    title="Nome entre 5 e 100 letras." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Marca</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Marca" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{3,100}$"
                                    title="Marca entre 3 e 100 letras." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Valor</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Valor" type="number" min="0" step="0.01"
                                    title="Valor numérico." required></p>
                            <p>
                                <label class="w3-text-IE"><b>Data</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
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
                                <input class="w3-radio" type="radio" name="Genero" value="Masculino" required>
                                <label class="w3-validate">Masculino</label>

                                <input class="w3-radio" type="radio" name="Genero" value="Feminino">
                                <label class="w3-validate">Feminino</label>

                                <input class="w3-radio" type="radio" name="Genero" value="Unisex">
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
                    </div>
                </div>
            </p>
        </div>

	<!-- FIM PRINCIPAL -->
	</div>

    <?php require "geral/footer.php" ?>

</body>
</html>