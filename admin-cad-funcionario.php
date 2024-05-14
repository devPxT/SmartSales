<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "login/verifica-login-admin.php" ?>

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
                    $sqlG = "SELECT id, nome FROM cargo WHERE id <> 1";
                    
                    $optionsCargo = array();
                    
                    if ($result = $conn->query($sqlG)) {
                        while ($row        = $result->fetch_assoc()) {
                        array_push($optionsCargo, "\t\t\t<option value='". $row["id"]."'>".$row["nome"]."</option>\n");
                        }
                    }
                    else{
                        echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn-> error . "</p>";
                    }
                    $conn->close();
                    ?>

                    <div class="w3-responsive w3-card-4">
                        <div class="w3-container w3-theme">
                            <h2>Informe os dados do novo Funcionário</h2>
                        </div>
                    <form class="w3-container" action="admin-cad-funcionario-EXE.php" method="post" enctype="multipart/form-data" onsubmit="return validarCPF()">
                        <table class='w3-table-all'>
                        <tr>
                            <td style="width: 50%">
                            <p>
                                <label class="w3-text-IE"><b>Nome</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{5,100}$"
                                    title="Nome entre 5 e 100 letras." required></p>

                            <?php $maxDate = date('Y-m-d', strtotime('-14 years')); ?>

                            <p>
                                <label class="w3-text-IE"><b>Data de Nascimento</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Data" type="date"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= $maxDate; ?>" required></p>
                                    
                            <p>
                                <label class="w3-text-IE"><b>CPF</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="CPF" id="CPF" type="text"
                                    title="CPF do funcionario (123.456.789-10)." placeholder="123.456.789-10" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required>
                                <p id="statusCPF" style="color: red; display: none"></p></p>
                            <p>
                                <label class="w3-text-IE"><b>Data de Cadastro</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="DataCad" type="date"
                                    placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>
                            <!-- <p>
                                <label class="w3-text-IE"><b>Email</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Email" id="email" type="email"
                                    title="Email do funcionário." placeholder="nome.sobrenome@dominio.com" pattern="^[a-zA-Z1-9.]+@( [a-zA-Z0-9.]+)*$"
                                    required></p> -->
                            <p>
                                <label class="w3-text-IE"><b>Cargo</b>*</label>
                                <select name="Cargo" id="Cargo" class="w3-input w3-border w3-light-grey" required>
                                    <option value=""></option>
                                <?php
                                    foreach($optionsCargo as $key => $value){
                                        echo $value;
                                    }
                                ?>
                                </select>
                            </p>

                            </td>
                            <td>
                                <p>
                                <label class="w3-text-IE"><b>Login</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Login" type="text"
                                    pattern="[a-zA-Z]{2,20}\.[a-zA-Z]{2,20}" placeholder="nome.sobrenome" title="nome.sobrenome" required></p>

                                <p>
                                <label class="w3-text-IE"><b>Senha Inicial</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Senha" id="Senha" type="password" onchange="validarSenha()"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
                                    title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                                    required></p>
                                <p>
                                <label class="w3-text-IE"><b>Confirma Senha Inicial</b>*</label>
                                <input class="w3-input w3-border w3-light-grey" name="Senha2" id="Senha2"type="password" onkeyup="validarSenha()"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
                                    title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                                    required> </p> 
                                <p>
                                <input type="checkbox" class="w3-btn w3-theme"  onclick="mostrarOcultarSenha()"> Mostrar senha
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <p>
                                <input type="submit" value="Salvar" class="btn btn-success" >
                                <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='admin-lst-funcionario.php'">
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