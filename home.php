<?php

include 'conexao.php';
include 'validacao.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - StellarCode</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
</head>

<body>
    <nav>
        <div class="nav-left">
            <img src="assets/img/logo.png" alt="Logo StellarCode">
        </div>
        <div class="nav-middle">
            <a href="graficos.php">Gráficos</a>
            <a href="home.php">Página Inicial</a>
            <a href="perfil.php">Perfil</a>
        </div>
        <div class="nav-right">
            <a href="logout.php" class="logout-link">
                <img src="assets/img/logout.png" alt="Sair" class="logout-img">
            </a>
        </div>
    </nav>

    <div class="main-content">
        <div class="home-area">
            <h1>Bem-vindo a</h1>
            <img src="assets/img/logo_nome.png" alt="Logo">

            <div class="buttons-home-area">
                <a href="graficos.php" class="button-area">Analisar Dados</a>
                <a href="perfil.php" class="button-area">Ver Perfil</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-middle">
            <div class="logo-footer">
                <a href="https://linkedin.com"><img src="assets/img/linkedin.png" alt="Linkedin"></a>
                <a href="https://instagram.com"><img src="assets/img/instagram.png" alt="Instagram"></a>
                <a href="https://gmail.com"><img src="assets/img/email.png" alt="Email"></a>
            </div>
            <p>Todos os direitos reservados</p>
        </div>
    </footer>
</body>

</html>