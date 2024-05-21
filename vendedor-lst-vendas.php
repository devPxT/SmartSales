<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-vendedor.php" ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedor</title>

    <?php require "geral/links.php" ?>
</head>
<body id="vendas">
<!-- navbar padrão -->
<?php require "geral/navbar.php" ?>
<!-- navbar padrão -->

<!-- conecta ao BD -->
<?php require 'bd/connection.php'; ?>
<!-- conecta ao BD -->
    <?php
        $conn = new mysqli($servername, $username, $password, $database);
        if (isset($_POST['tipoModal'])) {
            if ($conn->connect_error) {
                die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
            }

            $msg = '';
            $icon = '';
            $title = '';

            if ($_POST['tipoModal'] == 1) { //recebeu dados do modal de CADASTRO -> INSERT
                $estoque_id = $_POST['CADproduto']; // ID do ESTOQUE
                $cliente = $_POST['CADcliente'];
                $metodo = $_POST['CADmetodo'];
                $dtCad = $_POST['CADdtCad'];
                $qtd = $_POST['CADquantidade'];
                $data_cad = $_POST['CADdtCad'];

                $vendedor = $_SESSION['id'];

                //SQL que verifica se tem um cliente com esse CPF ANTES DO INSERT
                $sql = "SELECT quantidade FROM estoque WHERE id = $estoque_id";
                //verifica se deu erro no SELECT
                if ($result = $conn->query($sql)) {
                    $row = $result->fetch_assoc();
                    $quantidadeExistente = $row['quantidade'];
                    $novaQuantidade = $quantidadeExistente - $qtd;

                    if ($quantidadeExistente == 0) {
                        $title = 'Erro cadastrando venda!';
                        $msg = 'PRODUTO esgotado!';
                        $icon = 'error';

                        $_SESSION['dtCadVENDAS'] = $data_cad;
                        $_SESSION['qtdVENDAS'] = $qtd;
                    } else if ($novaQuantidade < 0) {
                        $title = 'Erro cadastrando venda!';
                        $msg = 'QUANTIDADE maior que produtos no estoque ('.($quantidadeExistente).' produtos)!';
                        $icon = 'error';

                        $_SESSION['dtCadVENDAS'] = $data_cad;
                        $_SESSION['qtdVENDAS'] = $qtd;
                    } else {

                        $sql3 = "INSERT INTO compra (quantidade, data_cad, cliente_id, funcionario_id, estoque_id, metodopagamento_id) 
                                 VALUES ($qtd,'$dtCad', $cliente, $vendedor, $estoque_id, $metodo)";
                        //verifica se deu erro no INSERT
                        if ($result3 = $conn->query($sql3)) {
                            $sql4 = "UPDATE estoque SET quantidade = quantidade - $qtd WHERE id = $estoque_id";
                            if ($conn->query($sql4)) {
                                $msg = 'Venda cadastrada com sucesso e estoque atualizado!'; // INSERT e UPDATE com sucesso 
                                $icon = 'success';

                                unset($_SESSION['dtCadVENDAS']);
                                unset($_SESSION['qtdVENDAS']);
                            } else {
                                // Erro ao atualizar o estoque
                                $title = 'Erro';
                                $msg = 'Venda cadastrada, mas erro ao atualizar o estoque'; // UPDATE com erro
                                $icon = 'error';
                            }
                        } else {
                            //echo $conn->connect_error;
                            $title = 'Erro';
                            $msg = 'Erro executando INSERT da venda'; // INSERT com erro
                            $icon = 'error';
                        }
                    }
                } else {
                    //echo $conn-> error;
                    $title = 'Erro';
                    $msg = 'Erro selecionando a quantidade do Produto';
                    $icon = 'error';
                }


            } else if ($_POST['tipoModal'] == 2) { //recebeu dados do modadel de UPDATE -> UPDATE

                $id = $_POST['ID'];
                $cliente = $_POST['UPDTcliente'];
                $metodo = $_POST['UPDTmetodo'];

                $sql = "UPDATE compra SET cliente_id = $cliente, metodopagamento_id = $metodo WHERE id = $id";
                if ($result = $conn->query($sql)) {
                    $msg = 'Registro alterado com sucesso!'; // UPDATE com sucesso 
                    $icon = 'success';


                } else {
                    $title = 'Erro';
                    $msg = 'Erro ao atualizar vendas!';
                    $icon = 'error';

                    // $_SESSION['nomeVENDASupdt'];
                    // $_SESSION['dtCadVENDASupdt'];
                    // $_SESSION['qtdVENDASupdt'];

                }


            } else { //recebeu dados do CLICK do DELETE -> DELETE
                $id = $_POST['ID'];
                $qtd = $_POST['QTD'];
                $estoque_id = $_POST['EST_ID'];

                 //SQL de DELETE no banco de dados
                $sql = "DELETE FROM compra WHERE id = $id";

                if ($result = mysqli_query($conn, $sql)) {
                    $sql2 = "UPDATE estoque SET quantidade = $qtd WHERE id = $estoque_id";

                    if ($result = $conn->query($sql2)) {
                        $msg = 'Registro excluído com sucesso!'; // DELETE com sucesso 
                        $icon = 'success';
                    } else {
                        $msg = 'Venda deletada mas estoque não atualizado';
                        $icon = 'error';
                    }

                } else {
                    $msg = 'Erro deletendo a venda';
                    $icon = 'error';
                }
            }
            //$conn->close();
        }

        $sqlG = "SELECT id, nome FROM cliente";
                        
        $optionsCliente = array();
        
        if ($result = $conn->query($sqlG)) {
            while ($row = $result->fetch_assoc()) {
            array_push($optionsCliente, "\t\t\t<option value='". $row["id"]."'>".$row["nome"]."</option>\n");
            }
        }
        else{
            echo "<p style='text-align:center'>Erro executando SELECT: " . $conn-> error . "</p>";
        }

        $sqlH = "SELECT t1.id, t2.nome, t1.tamanho, t1.cor FROM estoque t1 JOIN produto t2 ON t1.produto_id = t2.id WHERE t1.quantidade > 0;";
                        
        $optionsProduto = array();
        
        if ($result = $conn->query($sqlH)) {
            while ($row = $result->fetch_assoc()) {
            array_push($optionsProduto, "\t\t\t<option value='". $row["id"]."'>".$row["nome"]. " - " . $row["tamanho"] ." - ". $row["cor"]."</option>\n");
            }
        }
        else{
            echo "<p style='text-align:center'>Erro executando SELECT: " . $conn-> error . "</p>";
        }

        $sqlI = "SELECT id, nome FROM metodopagamento";
                        
        $optionsMetodo = array();
        
        if ($result = $conn->query($sqlI)) {
            while ($row = $result->fetch_assoc()) {
            array_push($optionsMetodo, "\t\t\t<option value='". $row["id"]."'>".$row["nome"]."</option>\n");
            }
        }
        else{
            echo "<p style='text-align:center'>Erro executando SELECT: " . $conn-> error . "</p>";
        }

        $conn->close();
    ?>

    <!-- Inicio Modal Cadastro (TIPO 1)-->
    <div class="modal fade" id="modalCadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCadastro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
            <div class="modal-content">
                <!-- FORM COM O ACTION PARA A MESMA PAGINA PARA INSERIR NO BANCO DE DADOS O CADASTRO -->
                <form id="formCadastro" class="needs-validation" novalidate method="post" action="vendedor-lst-vendas.php">
                <!-- FORM COM O ACTION PARA A MESMA PAGINA PARA INSERIR NO BANCO DE DADOS O CADASTRO -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCadastro">Cadastro de Vendas</h1>
                        <button type="button" class="btn-close cancel-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <!-- input para DIFERENCIAR o modal de CADASTRO do modal de UPDATE pois vai para a mesma página -->
                            <input name="tipoModal" type="hidden" value="1">
                            <!-- input para DIFERENCIAR o modal de CADASTRO do modal de UPDATE pois vai para a mesma página -->

                            <div class="col-12">
                                <label for="CADproduto" class="form-label">Produto</label>
                                <select name="CADproduto" id="CADproduto" class="form-select form-control" required>
                                    <option value="">Selecione um Produto...</option>
                                <?php
                                    foreach($optionsProduto as $key => $value2){
                                        echo $value2;
                                    }
                                ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um Produto.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="CADcliente" class="form-label">Cliente</label>
                                <select name="CADcliente" id="CADcliente" class="form-select form-control" required>
                                    <option value="">Selecione um Cliente...</option>
                                <?php
                                    foreach($optionsCliente as $key => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um Cliente.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="CADmetodo" class="form-label">Método de Pagamento</label>
                                <select name="CADmetodo" id="CADmetodo" class="form-select form-control" required>
                                    <option value="">Selecione um Método...</option>
                                <?php
                                    foreach($optionsMetodo as $key3 => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um Método de Pagamento.
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <label for="CADdtCad" class="form-label">Data de Cadastro</label>
                                <input type="date" class="form-control" max="<?= date('Y-m-d'); ?>" 
                                value="<?php echo isset($_SESSION['dtCadVENDAS']) ? $_SESSION['dtCadVENDAS'] : date('Y-m-d'); ?>" required
                                name="CADdtCad" id="CADdtCad">
                                <div class="invalid-feedback">
                                    Por favor preencha a data.
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <label for="CADquantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" required placeholder="Quantidade de produtos"
                                value="<?php echo isset($_SESSION['qtdVENDAS']) ? $_SESSION['qtdVENDAS'] : 1; ?>" min="1"
                                name="CADquantidade" id="CADquantidade">
                                <div class="invalid-feedback">
                                    Por favor insira uma quantidade de produtos.
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cancel-modal" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fim Modal Cadastro -->

    <!-- Inicio Modal Update (TIPO 2)-->
    <div class="modal fade" id="modalUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
            <div class="modal-content">
                <!-- FORM COM O ACTION PARA A MESMA PAGINA PARA INSERIR NO BANCO DE DADOS O CADASTRO -->
                <form id="formUpdate" class="needs-validation" novalidate method="post" action="vendedor-lst-vendas.php">
                <!-- FORM COM O ACTION PARA A MESMA PAGINA PARA INSERIR NO BANCO DE DADOS O CADASTRO -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCadastro">Atualização de Venda</h1>
                        <button type="button" class="btn-close cancel-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <!-- input para DIFERENCIAR o modal de CADASTRO do modal de UPDATE pois vai para a mesma página -->
                            <input name="tipoModal" type="hidden" value="2">
                            <!-- input para DIFERENCIAR o modal de CADASTRO do modal de UPDATE pois vai para a mesma página -->

                            <input name="ID" type="hidden" value="" id="ID">

                            <div class="col-12">
                                <label for="UPDTproduto" class="form-label">Produto</label>
                                <input type="text" class="form-control" disabled style="background-color: lightgray"
                                value="<?php echo isset($_SESSION['nomeVENDASupdt']) ? $_SESSION['nomeVENDASupdt'] : ''; ?>"
                                name="UPDTproduto" id="UPDTproduto">
                            </div>

                            <div class="col-12">
                                <label for="UPDTcliente" class="form-label">Cliente</label>
                                <select name="UPDTcliente" id="UPDTcliente" class="form-select form-control" required>
                                    <option value="">Selecione um Cliente...</option>
                                <?php
                                    foreach($optionsCliente as $key => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um Cliente.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="UPDTmetodo" class="form-label">Método de Pagamento</label>
                                <select name="UPDTmetodo" id="UPDTmetodo" class="form-select form-control" required>
                                    <option value="">Selecione um Método...</option>
                                <?php
                                    foreach($optionsMetodo as $key3 => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um Método de Pagamento.
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <label for="UPDTdtCad" class="form-label">Data de Cadastro</label>
                                <input type="date" class="form-control" disabled style="background-color: lightgray"
                                value="<?php echo isset($_SESSION['dtCadVENDASupdt']) ? $_SESSION['dtCadVENDASupdt'] : date('Y-m-d'); ?>"
                                name="UPDTdtCad" id="UPDTdtCad">
                            </div>

                            <div class="col-sm-6 col-12">
                                <label for="UPDTquantidade" class="form-label">Quantidade</label>
                                <!-- <input type="number" class="form-control" required placeholder="Quantidade de produtos"
                                value="< //echo isset($_SESSION['qtdVENDAS']) ? $_SESSION['qtdVENDAS'] : 1; ?>" min="1"
                                name="UPDTquantidade" id="UPDTquantidade"> -->
                                <input type="number" class="form-control" disabled style="background-color: lightgray"
                                value="<?php echo isset($_SESSION['qtdVENDASupdt']) ? $_SESSION['qtdVENDASupdt'] : "";?>" min="1"
                                name="UPDTquantidade" id="UPDTquantidade">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cancel-modal" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fim Modal Update -->


    <div class="container-fluid mt-3 home">

        <div class="container-fluid">   
            <div class="title-text">
                VENDAS
            </div>
        </div>
        

        <div class="container-fluid mt-3">
            <form action="vendedor-lst-vendas.php" method="post">
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-12">
                        <button type="button" class="btn btn-primary mb-3 w-100" data-bs-toggle="modal" data-bs-target="#modalCadastro">Novo</button>
                    </div>
                    <div class="col-lg-6 col-sm-7 col-12">
                            <label for="inputPesquisa" class="visually-hidden">Pesquisar</label>
                            <input type="text" name="pesquisa" class="form-control mb-3" id="inputPesquisa" placeholder="Buscar..."
                                value="<?php echo isset($_POST['pesquisa']) ? $_POST['pesquisa'] : ''; ?>">
                    </div>
                    <div class="col-lg-2 col-sm-3 col-12">
                        <button type="submit" class="btn btn-success mb-3 w-100">Pesquisar</button>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-12">
                        <button type="button" class="btn btn-secondary mb-3 w-100" onclick="window.location.href='home.php'">Voltar</button>
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
                if (isset($_POST['pesquisa'])) {
                    $nomeProduto = $_POST['pesquisa'];
                }
                // Faz Select na Base de Dados
                $sql = "SELECT t1.id, t2.nome as produto, t3.tamanho, t3.cor, 
                        t2.valor, t6.nome as metodo, t1.quantidade, 
                        t4.nome as vendedor, t5.nome as cliente, 
                        t1.data_cad, t1.data_updt,
                        (t2.valor * t1.quantidade) AS valorTotal,
                        t1.estoque_id
                        FROM compra t1
                        JOIN estoque t3 ON t1.estoque_id = t3.id
                        JOIN produto t2 ON t3.produto_id = t2.id
                        JOIN funcionario t4 ON t1.funcionario_id = t4.id
                        JOIN cliente t5 ON t1.cliente_id = t5.id
                        JOIN metodopagamento t6 ON t1.metodopagamento_id = t6.id";
                // If Isset para verificar se recebeu o nomeProduto para concatenar o WHERE e fazer a pesquisa
                if (isset($_POST['pesquisa'])) {
                    $sql = $sql . " WHERE t2.nome LIKE '$nomeProduto%'";
                }
            ?>

                <div class='table-responsive table-wrapper'>
                    <table class='table table-striped table-hover rounded-3 overflow-hidden' id='myTable'>
                        <thead class='thead-yellow'>
                            <tr>
                                <th scope='col'>Código</th>
                                <th scope='col'>Produto</th>
                                <th scope='col'>Tamanho</th>
                                <th scope='col'>Cor</th>
                                <th scope='col'>Valor</th>
                                <th scope='col'>Pagamento</th>
                                <th scope='col'>Quantidade</th>
                                <th scope='col'>Valor Total</th>
                                <th scope='col'>Vendedor</th>
                                <th scope='col'>Cliente</th>
                                <th scope='col'>Dt Cad.</th>
                                <th scope='col'>Dt Atual.</th>
                                <th scope='col'> </th> <!-- coluna para edit e delete -->
                            </tr>
                        </thead>

            <?php
                if ($result = $conn->query($sql)) {
                    
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc() ) {
                            $cod = $row["id"];
                            $qtd = $row["quantidade"];
                            $estoque_id = $row["estoque_id"];

                            $dataN = explode('-', $row["data_cad"]);
                            $ano_cad = $dataN[0];
                            $mes_cad = $dataN[1];
                            $dia_cad = $dataN[2];
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
                            echo " <form method='post' action='vendedor-lst-vendas.php'>"; //FORM em cada linha para EXCLUIR funcionar
                            echo "  <input name='tipoModal' type='hidden' value='3'>"; //INPUT name = tipoModal 3 para ser o MODAL de DELETE na lógica no começo da página
                            echo "  <input name='ID' type='hidden' value='$cod'>"; //INPUT ID = $cod para o DELETE deletar pelo ID desse CAMPO
                            echo "  <input name='QTD' type='hidden' value='$qtd'>"; //INPUT QTD = $qtd para o DELETE dar UPDATE no estoque
                            echo "  <input name='EST_ID' type='hidden' value='$estoque_id'>"; //INPUT EST_ID = $estoque_id para o DELETE dar UPDATE no estoque
                            echo " </form>";
                            echo "  <th scope'row'>";
                            echo $cod;
                            echo "  </th><td>";
                            echo $row["produto"];
                            echo "  </td><td>";
                            echo $row["tamanho"];
                            echo "  </td><td>";
                            echo $row["cor"];
                            echo "  </td><td>";
                            echo "R$ ".$row["valor"];
                            echo "  </td><td>";
                            echo $row["metodo"];
                            echo "  </td><td>";
                            echo $row["quantidade"];
                            echo "  </td><td>";
                            echo "R$ ".$row["valorTotal"];
                            echo "  </td><td>";
                            echo $row["vendedor"];
                            echo "  </td><td>";
                            echo $row["cliente"];
                            echo "  </td><td>";
                            echo $nova_data_cad;
                            echo "  </td><td>";
                            echo $nova_data_updt;
                            echo "  </td>";
            ?>                      
                                <td>
                                    <button type="button" class="btn btn-outline-danger" title="Excluir" 
                                    onclick="deletar(this)">
                                        <a class="bi bi-trash"></a>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" title="Editar"
                                    onclick="editar(this, <?php echo $cod ?>)">
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
                        echo "<th scope'row' colspan='13'>Sem nenhum registro no momento.</th>";
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

        function editar(element, ID) {
            var row = $(element).closest('tr');
            var id = row.find('th').text().trim();
            var produto = row.find('td').eq(0).text().trim();
            var qtd = row.find('td').eq(5).text().trim();

            var dt = row.find('td').eq(9).text().trim();

            var dtParts = dt.split('/');
            var dtFormatted = dtParts[2] + '-' + dtParts[1] + '-' + dtParts[0];

            $('#ID').val(id);
            $('#UPDTproduto').val(produto);
            $('#UPDTdtCad').val(dtFormatted);
            $('#UPDTquantidade').val(qtd);
            // $('#cpf').val(cpf);
            // $('#celular').val(celular);
            // $('#email').val(email);
            $('#modalUpdate').modal('toggle');
        }
    </script>

    <?php
        if (isset($_POST['tipoModal'])) {
    ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            })
        </script>
    <?php
            if ($_POST['tipoModal'] == 3) {
    ?>
            <script>
                Toast.fire({
                    icon: '<?php echo $icon ?>',
                    title: '<?php echo $msg ?>'
                });
            </script>
    <?php
            } else if ($_POST['tipoModal'] == 2) {
    ?>
            <script>
                if ('<?php echo $icon ?>' == 'error') {
                    Swal.fire({
                        icon: '<?php echo $icon ?>',
                        title: '<?php echo $title ?>',
                        text: '<?php echo $msg?>',
                        confirmButtonColor: "#ffc107"
                    }).then(() => {
                        $('#modalUpdate').modal('toggle');
                    })
                } else {
                    Toast.fire({
                        icon: '<?php echo $icon ?>',
                        title: '<?php echo $msg ?>'
                    });
                }
            </script>
    <?php        


            } else {
    ?>
            <script>
                if ('<?php echo $icon ?>' == 'error') {
                    Swal.fire({
                        icon: '<?php echo $icon ?>',
                        title: '<?php echo $title ?>',
                        text: '<?php echo $msg?>',
                        confirmButtonColor: "#ffc107"
                    }).then(() => {
                        $('#modalCadastro').modal('toggle');
                    })
                } else {
                    Toast.fire({
                        icon: '<?php echo $icon ?>',
                        title: '<?php echo $msg ?>'
                    });
                }
            </script>
    <?php
            }
        }
    ?>
    
    <script src="js/validate-forms.js"></script>
</body>
</html>