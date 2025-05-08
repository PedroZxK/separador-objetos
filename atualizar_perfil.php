<?php
include 'conexao.php';
include 'validacao.php';

$novoNome = $_POST['nome'] ?? '';
$novoEmail = $_POST['email'] ?? '';
$idUsuario = $_SESSION['email'];

$fotoBinario = null;
$temNovaFoto = false;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fotoBinario = file_get_contents($_FILES['foto']['tmp_name']);
    $temNovaFoto = true;
}

if ($temNovaFoto) {
    $sql = "UPDATE usuarios SET name=?, email=?, foto=? WHERE email=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $novoNome, $novoEmail, $fotoBinario, $idUsuario);
} else {
    $sql = "UPDATE usuarios SET name=?, email=? WHERE email=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $novoNome, $novoEmail, $idUsuario);
}

if ($stmt->execute()) {
    $_SESSION['name'] = $novoNome;
    $_SESSION['email'] = $novoEmail;
    header("Location: perfil.php");
    exit();
} else {
    echo "Erro ao atualizar perfil.";
}
?>
