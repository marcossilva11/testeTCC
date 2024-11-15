<?php
// Conexão com o banco de dados
include 'conexao.php';

// Recebe os dados enviados pelo React Native
$data = json_decode(file_get_contents("php://input"));

$rmalu = $data->rmalu;
$alusenha = $data->alusenha;

// Verifica se os campos foram preenchidos
if (empty($rmalu) || empty($alusenha)) {
    echo json_encode(['success' => false, 'message' => 'Preencha RM e senha!']);
    exit;
}

// Verifica se o aluno existe no banco
$query = "SELECT * FROM alunos WHERE rmalu = '$rmalu'";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

if ($row && password_verify($alusenha, $row['alusenha'])) {
    echo json_encode(['success' => true, 'message' => 'Login bem-sucedido!']);
} else {
    echo json_encode(['success' => false, 'message' => 'RM ou senha incorretos!']);
}

mysqli_close($conexao);
?>
