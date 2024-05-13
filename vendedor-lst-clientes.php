<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-vendedor.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>

    <?php require "geral/links.php" ?>

</head>
<body id="vendas">
<!-- navbar padrão (já tem o session_start() dentro dela) -->
<?php require "geral/navbar.php" ?>
<!-- navbar padrão (já tem o session_start() dentro dela) -->

<!-- conecta ao BD -->
<?php require 'bd/connection.php'; ?>
<!-- conecta ao BD -->

    <?php
        if (isset($_POST['tipoModal'])) {
            $msg = '';
            if ($_POST['tipoModal'] == 1) { //RECEBEU DADOS DO MODAL DE CADASTRO

            } else { //RECEBEU DADOS DO MODAL DE UPDATE

            }
            ?>
            <script>
                Swal.fire({
                    title: "Oops",
                    text: <?php echo $_POST['tipoModal']?>,
                    icon: "info"
                })
            </script>
            <?php
        }
    ?>

    <!-- Inicio Modal Cadastro (TIPO 1)-->
    <div class="modal fade" id="modalCadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCadastro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <!-- FORM COM O ACTION PARA A MESMA PAGINA PARA INSERIR NO BANCO DE DADOS O CADASTRO -->
                <form id="formCadastro" class="needs-validation" novalidate method="post" action="vendedor-lst-clientes.php">
                <!-- FORM COM O ACTION PARA A MESMA PAGINA PARA INSERIR NO BANCO DE DADOS O CADASTRO -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCadastro">Cadastro de Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <!-- input para DIFERENCIAR o modal de CADASTRO do modal de UPDATE pois vai para a mesma página -->
                            <input name="tipoModal" type="hidden" value="1">
                            <!-- input para DIFERENCIAR o modal de CADASTRO do modal de UPDATE pois vai para a mesma página -->
                            <div class="col-md-6 col-12">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" pattern="[a-zA-Z\u00C0-\u00FF ]{3,100}$" required placeholder="Ana"
                                data-bs-toggle="tooltip" data-bs-title="Nome com 3 a 100 letras" data-bs-custom-class="custom-tooltip"
                                name="nome">
                                <div class="invalid-feedback">
                                    Por favor preencha o nome de 3 a 100 letras.
                                </div>
                            </div>
                            <?php $maxDate = date('Y-m-d', strtotime('-1 years')); ?>
                            <div class="col-md-6 col-12">
                                <label for="dtNasc" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" max="<?= $maxDate; ?>" id="dtNasc" required
                                data-bs-toggle="tooltip" data-bs-title="Data de nascimento do cliente" data-bs-custom-class="custom-tooltip"
                                name="dtNasc">
                                <div class="invalid-feedback">
                                    Por favor preencha a data.
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required placeholder="xxx.xxx.xxx-xx"
                                data-bs-toggle="tooltip" data-bs-title="CPF do cliente com pontuação" data-bs-custom-class="custom-tooltip"
                                name="cpf">
                                <div class="invalid-feedback">
                                    Por favor preencha o CPF.
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="celular" required placeholder="(41)98765-4321"
                                data-bs-toggle="tooltip" data-bs-title="Celular do cliente com DDD e 9 digitos" data-bs-custom-class="custom-tooltip"
                                name="celular">
                                <div class="invalid-feedback">
                                    Por favor preencha o Celular.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" required placeholder="exemplo@gmail.com"
                                data-bs-toggle="tooltip" data-bs-title="Email do cliente" data-bs-custom-class="custom-tooltip"
                                name="email">
                                <div class="invalid-feedback">
                                    Por favor preencha o Email.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fim Modal Cadastro -->


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
                        <button type="button" class="btn btn-primary mb-3 w-100" data-bs-toggle="modal" data-bs-target="#modalCadastro">Novo</button>
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
                $sql = "SELECT id, nome, email, celular, CPF, dt_nasc, data_cad, data_updt FROM cliente";
                // If Isset para verificar se recebeu o nomeCliente para concatenar o WHERE e fazer a pesquisa
                if (isset($nomeCliente)) {
                    $sql = $sql . " WHERE nome LIKE '$nomeCliente%'";
                }
            ?>

                <div class='table-responsive table-wrapper'>
                    <table class='table table-striped table-hover rounded-3 overflow-hidden' id='myTable'>
                        <thead class='thead-yellow'>
                            <tr>
                                <th scope='col'>Código</th>
                                <th scope='col'>Nome</th>
                                <th scope='col'>Dt Nasc</th>
                                <th scope='col'>Idade</th>
                                <th scope='col'>CPF</th>
                                <th scope='col'>Celular</th>
                                <th scope='col'>Email</th>
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
                            echo $dt_nasc;
                            echo "  </td><td>";
                            echo $idade;
                            echo "  </td><td>";
                            echo $row["CPF"];
                            echo "  </td><td>";
                            echo $row["celular"];
                            echo "  </td><td>";
                            echo $row["email"];
                            echo "  </td>";
            ?>                      
                                <td>
                                    <button type="button" class="btn btn-outline-danger" title="Excluir" >
                                        <a class="bi bi-trash" onclick="dev(event)"></a>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" title="Editar" >
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

    <script src="js/validate-forms.js"></script>

    <script>
        // evita o resend de formulario quando atualiza a pagina
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        // evita o resend de formulario quando atualiza a pagina
    </script>
</body>
</html>