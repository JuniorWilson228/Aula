<?php
// Conexão com banco de dados
$host = "localhost";
$usuario = "root";
$senha = ""; // ou a senha definida
$banco = "meubanco";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

// Recebendo os dados do POST
$nome = $_POST['nome'] ?? '';
$aluno = $_POST['aluno'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

// Validação básica
if ($nome && $aluno && $mensagem) {
  $stmt = $conn->prepare("INSERT INTO registros (nome, aluno, mensagem) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nome, $aluno, $mensagem);

  if ($stmt->execute()) {
    echo "Registro salvo com sucesso!";
  } else {
    echo "Erro ao salvar: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Preencha todos os campos.";
}

$conn->close();
?>
