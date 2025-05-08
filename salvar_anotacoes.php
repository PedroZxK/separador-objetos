<?php
include 'conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['anotacoes'])) {
        $anotacoes = $_POST['anotacoes'];
        $emailUsuario = $_SESSION['email'];

        $stmt = $mysqli->prepare("UPDATE usuarios SET anotacoes = ? WHERE email = ?");
        $stmt->bind_param("ss", $anotacoes, $emailUsuario);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
        $stmt->close();
    } else {
        echo "error";
    }
    $mysqli->close();
} else {
    echo "error";
}
