<?php
session_start();

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo 'Por favor, preencha todos os campos do formulário.';
        exit();
    } else {
        $sql = "SELECT id, email, password, name FROM usuarios WHERE email = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $dbEmail, $dbPassword, $dbName);

            if ($stmt->fetch() && password_verify($password, $dbPassword)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $dbName;
                header('Location: home.php');
                exit();
            } else {
                echo 'Credenciais incorretas.';
            }
            $stmt->close();
        } else {
            echo 'Erro ao preparar a declaração: ' . $mysqli->error;
        }
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StellarCode</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
</head>

<body>
    <nav>
        <div class="nav-left">
            <img src="assets/img/logo.png" alt="Logo StellarCode">
        </div>
        <div class="nav-right">
            <a href="index.html" class="button-nav">Página Inicial</a>
        </div>
    </nav>

    <form action="" method="POST">
        <h1>Faça o seu Login</h1>

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Insira o seu Email" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" placeholder="Insira a sua Senha" required>

        <button type="submit">Entrar</button>

        <div class="options-login">
            <!-- <div class="text-options">
                <hr>
                <p>Outras opções</p>
                <hr>
            </div>
            <div class="logos-options">
                <img src="assets/img/google.png" alt="Google">
                <img src="assets/img/facebook.png" alt="Facebook">
            </div> -->

            <a href="cadastro.php">Não tem uma conta?<span class="sign-account"> Criar Conta</span></a>
        </div>
    </form>
</body>

</html>