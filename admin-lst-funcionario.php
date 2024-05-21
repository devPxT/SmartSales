<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-admin.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>

    <?php require "geral/links.php" ?>

</head>
<body id="admin">
    <?php require "geral/navbar.php" ?>

    <?php require 'bd/connection.php'; ?>


        <div class="container-fluid mt-3 home">

            <div class="container-fluid">
                <div class="title-text">
                    FUNCIONÁRIOS
                </div>
            </div>
            

            <div class="container-fluid mt-3">
                <form action="admin-lst-funcionario.php" method="post">
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-3">
                            <button type="button" class="btn btn-primary mb-3 w-100" onclick="window.location.href='admin-cad-funcionario.php'">Novo</button>
                        </div>
                        <div class="col-lg-6 col-sm-7 col-9">
                            
                                <label for="inputPesquisa" class="visually-hidden">Pesquisar</label>
                                <input type="text" name="nomeFuncionario" class="form-control mb-3" id="inputPesquisa" placeholder="Nome do Funcionario..."
                                value="<?php echo isset($_POST['nomeFuncionario']) ? $_POST['nomeFuncionario'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-sm-3 col-12">
                            <button type="submit" class="btn btn-success mb-3 w-100">Pesquisar</button>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-12">
                            <button type="button" class="btn btn-secondary mb-3 w-100" onclick="window.location.href='admin-home.php'">Voltar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-fuid mt-3 ms-lg-2 me-lg-2 shadow-lg rounded-3">
                <!-- Acesso ao BD-->
                <?php
                    // Cria conexão
                    $conn = new mysqli($servername, $username, $password, $database);
                    // Verifica conexão 
                    if ($conn->connect_error) {
                        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
                    }
                    if (isset($_POST['nomeFuncionario'])) {
                        $nomeFuncionario = $_POST['nomeFuncionario'];
                    }
                    // Faz Select na Base de Dados
                    $sql = "SELECT t1.id, t1.nome, t1.dt_nasc, t1.cpf, t1.login, t1.data_cad, t1.data_updt, t2.nome AS cargo FROM funcionario t1 JOIN cargo t2 ON t1.cargo_id = t2.id WHERE t1.cargo_id <> 1";
                    if (isset($nomeFuncionario)) {
                        $sql = $sql . " AND t1.nome LIKE '$nomeFuncionario%'";
                    }

                    ?>
                    <div class='table-responsive table-wrapper'>
                        <table class='table table-striped table-hover rounded-3 overflow-hidden' id='myTable'>
                            <thead class='thead-yellow'>
                                <tr>
                                    <th scope='col'>Código</th>
                                    <th scope='col'>Nome</th>
                                    <th scope='col'>Data Nascimento</th>
                                    <th scope='col'>Idade</th>
                                    <th scope='col'>CPF</th>
                                    <th scope='col'>Login</th>
                                    <th scope='col'>Cargo</th>
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
                                $data = $row['dt_nasc'];
                                list($ano, $mes, $dia) = explode('-', $data);
                                $nova_data = $dia . '/' . $mes . '/' . $ano;
                                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                                $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
                                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

                                $dataY = explode('-', $row["dt_nasc"]);
                                $anoY = $dataY[0];
                                $mesY = $dataY[1];
                                $diaY = $dataY[2];
                                $dt_nasc = $diaY . '/' . $mesY . '/' . $anoY;
                                
                                $dataN = explode('-', $row["data_cad"]);
                                $ano_cad = $dataN[0];
                                $mes_cad = $dataN[1];
                                $dia_cad = $dataN[2];
                                $cod = $row["id"];
                                $nova_data_cad = $dia_cad . '/' . $mes_cad . '/' . $ano_cad;

                                $nova_data_updt = '';
                                if ($row["data_updt"] != null) {
                                    $dataM = explode('-', $row["data_updt"]);
                                    $ano_updt = $dataM[0];
                                    $mes_updt = $dataM[1];
                                    $dia_updt = $dataM[2];
                                    $nova_data_updt = $dia_updt . '/' . $mes_updt . '/' . $ano_updt;
                                }
                                echo "<tr>";
                                echo "  <th scope'row'>";
                                echo $cod;
                                echo "  </th><td>";
                                echo $row["nome"];
                                echo "  </td><td>";
                                echo $dt_nasc;
                                echo "  </td><td>";
                                echo $idade;
                                echo "  </td><td>";
                                echo $row["cpf"];
                                echo "  </td><td>";
                                echo $row["login"];
                                echo "</td><td>";
                                echo $row["cargo"];
                                echo "</td><td>";
                                echo $nova_data_cad;
                                echo "  </td><td>";
                                echo $nova_data_updt;
                                echo "  </td>";
                    ?>                      
                                    <td>
                                        <button type="button" class="btn btn-outline-danger" title="Excluir"
                                        onclick="window.location.href='admin-del-funcionario.php?id=<?php echo $cod; ?>'">
                                            <a class="bi bi-trash"></a>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" title="Editar"
                                        onclick="window.location.href='admin-updt-funcionario.php?id=<?php echo $cod; ?>'">
                                            <a class="bi bi-pencil-square"></a>
                                        </button>
                                    </td>
                                </tr>
                    <?php
                            }
                            echo "</tbody>";
                        } else {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<th scope'row' colspan='10'>Nenhum registro.</th>";
                            echo "</tr>";
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
        // evita o resend de formulario quando atualiza a pagina
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        // evita o resend de formulario quando atualiza a pagina
    </script>

</body>
</html>