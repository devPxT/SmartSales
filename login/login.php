<html>
<!-- Login.php --> 
	<head>
      <meta charset="UTF-8">  
	  <title>Login</title>

	</head>
<body>

<?php
    session_start(); // infomra ao PHP que iremos trabalhar com sessão
    require '../bd/connection.php'; 
    
    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão 
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    $usuario = $_POST['usuario']; // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $_POST['senha']; // prepara a string recebida para ser utilizada em comando SQL

    // Faz Select na Base de Dados
    $sql = "SELECT t1.id, t1.nome, t2.id cargo_id, t2.nome cargo_nome FROM funcionario t1, cargo t2 WHERE t2.id = t1.cargo_id AND login = '$usuario' AND senha = md5('$senha');";

    if ($result = $conn->query($sql)) {
        if ($result->num_rows == 1) {         // Deu match: login e senha combinaram
            $row = $result->fetch_assoc();
            $_SESSION ['login'] = $usuario;
            $_SESSION ['cargo_nome'] = $row['cargo_nome'];
            $_SESSION ['cargo_id'] = $row['cargo_id'];
            $_SESSION ['id'] = $row['id'];
            $_SESSION ['nome'] = $row['nome'];
            unset($_SESSION['nao_autenticado']);                         // Agora está logado
            if( $_SESSION ['cargo_id'] == 1){
                $_SESSION ['admin'] = true;
                $conn->close();  //Encerra conexao com o BD
                // header('location: /SiteSample2023/professor.php');  // Perfil Administrador
                // exit();
            }else {
                $_SESSION ['admin'] = false;
                $conn->close();  //Encerra conexao com o BD                          
                // header('location: /SiteSample2023/professor/perfilProf.php');  // Perfil Professor   
                // exit();
            }
            header('location: ../home.php');
            exit();
        }else{
            $_SESSION['nao_autenticado'] = true;
            $_SESSION['mensagem_header'] = "Login";
            $_SESSION['mensagem']        = "Usuário ou senha incorretos.";
            $conn->close();  //Encerra conexao com o BD
            header('location: ../index.php'); 
            exit();
        }
    }
    else {
        $msg = "Erro ao acessar o BD: " . $conn-> error . ".";
        $_SESSION['nao_autenticado'] = true;
        $_SESSION['mensagem_header'] = "Login";
        $_SESSION['mensagem']        = $msg;
        $conn->close();  //Encerra conexao com o BD
        header('location: ../index.php'); 
    }
?>
	</body>
</html>

