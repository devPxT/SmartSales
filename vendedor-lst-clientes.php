<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-vendedor.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>

    <?php require "geral/links.php" ?>

    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body id="vendas">
    <style>

    </style>
    
    <?php require "geral/navbar.php" ?>

    <!-- conecta ao BD -->
    <?php require 'bd/connection.php'; ?>

    <div class="container-fluid mt-3 home">

        <div class="container-fluid">
            <div class="title-text">
                CLIENTES
            </div>
        </div>
        

        <div class="container-fluid mt-3">
            <form action="vendedor-lst-clientes.php" method="post">
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-12">
                        <button type="button" class="btn btn-primary mb-3 w-100" onclick="window.location.href='admin-cad-categoria.php'">Novo</button>
                    </div>
                    <div class="col-lg-6 col-sm-7 col-12">
                            <label for="inputPesquisa" class="visually-hidden">Pesquisar</label>
                            <input type="text" name="nomeCliente" class="form-control mb-3" id="inputPesquisa" placeholder="Nome do Cliente..."
                                value="<?php echo isset($_POST['nomeCliente']) ? $_POST['nomeCliente'] : ''; ?>">
                    </div>
                    <div class="col-lg-2 col-sm-3 col-12">
                        <button type="submit" class="btn btn-success mb-3 w-100">Pesquisar</button>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-12">
                        <button type="button" class="btn btn-secondary mb-3 w-100" onclick="window.location.href='vendedor-home.php'">Voltar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- COR TABLE #ffc107 -->
        <div class="container-fuid mt-3 ms-lg-2 me-lg-2 shadow-lg rounded-3">
            <?php
                // Cria conexão
                $conn = new mysqli($servername, $username, $password, $database);
                // Verifica conexão 
                if ($conn->connect_error) {
                    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                }
                if (isset($_POST['nomeCliente'])) {
                    $nomeCliente = $_POST['nomeCliente'];
                }
                // Faz Select na Base de Dados
                $sql = "SELECT * FROM cliente";
                // If Isset para verificar se recebeu o nomeCliente para concatenar o WHERE e fazer a pesquisa
                if (isset($nomeCliente)) {
                    $sql = $sql . " WHERE t1.nome LIKE '$nomeCliente%'";
                }
            ?>

                <div class='table-responsive table-wrapper'>
                    <table class='table table-striped table-hover rounded-3 overflow-hidden' id='myTable'>
                        <thead class='thead-yellow'>
                            <tr>
                                <th scope='col'>Código</th>
                                <th scope='col'>Categoria</th>
                                <th scope='col'>Data de Cadastro</th>
                                <th scope='col'>Data de Atualização</th>
                                <th scope='col'> </th>
                            </tr>
                        </thead>

            <?php
                if ($result = $conn->query($sql)) {
                    
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc() ) {
                            $dataN = explode('-', $row["data_cad"]);
                            $ano_cad = $dataN[0];
                            $mes_cad = $dataN[1];
                            $dia_cad = $dataN[2];
                            $cod = $row["id"];
                            $nova_data_cad = $dia_cad . '/' . $mes_cad . '/' . $ano_cad;

                            $nova_data_updt = '';
                            if ($row["data_updt"] != null) {
                                $dataM = explode('-', $row["data_updt"]);
                                $ano_updt = $dataN[0];
                                $mes_updt = $dataN[1];
                                $dia_updt = $dataN[2];
                                $nova_data_updt = $dia_updt . '/' . $mes_updt . '/' . $ano_updt;
                            }
                            echo "<tr>";
                            echo "  <th scope'row'>";
                            echo $cod;
                            echo "  </th><td>";
                            echo $row["nome"];
                            echo "  </td><td>";
                            echo $nova_data_cad;
                            echo "  </td><td>";
                            echo $nova_data_updt;
                            echo "  </td>";
            ?>                      
                                <td>
                                    <button type="button" class="btn btn-outline-danger" 
                                    data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir categoria" data-bs-custom-class="custom-grid-tooltip"                               
                                    onclick="window.location.href='admin-del-categoria.php?id=<?php echo $cod; ?>'">
                                        <a class="bi bi-trash"></a>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" 
                                    data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar categoria" data-bs-custom-class="custom-grid-tooltip"
                                        >
                                        <a class="bi bi-pencil-square" onclick="dev(event)" ></a>
                                    </button>
                                </td>
                            </tr>
            <?php
                        }
                        echo "</tbody>";
                    }
                    echo "  </table>";
                    echo "</div>";
                } else {
                    echo "Erro executando SELECT: " . $conn->connect_error;
                }
                $conn->close();
            ?>
        </div>
    </div>

    <?php require "geral/footer.php" ?>


    <script>
        // Swal.fire("SweetAlert2 is working!");

    </script>
</body>
</html>