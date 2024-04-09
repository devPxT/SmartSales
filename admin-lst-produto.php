<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>

    <?php require "geral/links.php" ?>

    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body id="admin">
    
    <?php require "geral/navbar.php" ?>

    <?php require 'bd/connection.php'; ?>

    <div class="container-fluid mt-3">
        <div class="title-text">
            PRODUTOS
        </div>
    <div>

    <div class="container-fluid mt-3">
        <form class="row g-3">
            <div class="col-auto">
                <button type="button" class="btn btn-success" onclick="window.location.href='admin-cad-produto.php'">Novo</button>
            </div>
            <div class="col-4">
                <label for="inputPesquisa" class="visually-hidden">Pesquisar</label>
                <input type="text" class="form-control" id="inputPesquisa" placeholder="Pesquisar">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success mb-3">Pesquisar</button>
            </div>
        </form>
    </div>

    <div class="container-fuid mt-3 ms-lg-3 me-lg-3">

        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <p class="w3-large">
            <p>
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
                <div class="w3-container w3-theme">
                <h2>Listagem de Produtos</h2>
                </div>

                <!-- Acesso ao BD-->
                <?php

                    // Cria conexão
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Verifica conexão 
                    if ($conn->connect_error) {
                        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                    }


                    // Faz Select na Base de Dados
                    $sql = "SELECT t1.id, t1.nome, t1.marca, t1.valor, t1.data, t2.nome AS categoria, t1.genero FROM produto t1 JOIN categoria t2 ON t1.categoria_id = t2.id";
                    echo "<div class='w3-responsive w3-card-4'>";
                    if ($result = $conn->query($sql)) {
                        echo "<table class='w3-table-all'>";
                        echo "	<tr>";
                        echo "	  <th>Código</th>";
                        echo "	  <th>Nome</th>";
                        echo "	  <th>Marca</th>";
                        echo "	  <th>Valor</th>";
                        echo "	  <th>Data Cad.</th>";
                        echo "	  <th>Categoria</th>";
                        echo "	  <th>Genêro</th>";
                        echo "	  <th> </th>";
                        echo "	  <th> </th>";
                        echo "	</tr>";
                        if ($result->num_rows > 0) {
                            // Apresenta cada linha da tabela
                            while ($row = $result->fetch_assoc() ) {
                                $dataN = explode('-', $row["data"]);
                                $ano = $dataN[0];
                                $mes = $dataN[1];
                                $dia = $dataN[2];
                                $cod = $row["id"];
                                $nova_data = $dia . '/' . $mes . '/' . $ano;
                                echo "<tr>";
                                echo "<td>";
                                echo $cod;
                                echo "</td><td>";
                                echo $row["nome"];
                                echo "</td><td>";
                                echo $row["marca"];
                                echo "</td><td>";
                                echo $row["valor"];
                                echo "</td><td>";
                                echo $nova_data;
                                echo "</td><td>";
                                echo $row["categoria"];
                                echo "</td><td>";
                                echo $row["genero"];
                                echo "</td><td>";
                                //Atualizar e Excluir registro de prof
                ?>                      
                                <a href='admin-updt-produto.php?id=<?php echo $cod; ?>'><img src='icons/Edit.png' title='Editar Professor' width='32'></a>
                                </td><td>
                                <a href='admin-updt-produto.php?id=<?php echo $cod; ?>'><img src='icons/Delete.png' title='Excluir Professor' width='32'></a>
                                </td>
                                </tr>
                <?php
                            }
                        }
                            echo "</table>";
                            echo "</div>";
                    } else {
                        echo "Erro executando SELECT: " . $conn->connect_error;
                    }

                    $conn->close();

                ?>
            </div>
        </div>

    <div>

    <?php require "geral/footer.php" ?>

</body>
</html>