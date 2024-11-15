<?php
// Conexão com o banco de dados
include 'conexao.php'; // Se ainda não tiver, crie o arquivo de conexão

// Recebe os dados enviados pelo React Native
$data = json_decode(file_get_contents("php://input"));

$rmalu = $data->rmalu;
$nomealu = $data->nomealu;
$emailalu = $data->emailalu;
$alusenha = $data->alusenha;
$nometur = $data->nometur;

// Verifica se todos os campos foram preenchidos
if (empty($rmalu) || empty($nomealu) || empty($emailalu) || empty($alusenha) || empty($nometur)) {
    echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios!']);
    exit;
}

// Hash da senha
$alusenha_hash = password_hash($alusenha, PASSWORD_BCRYPT);

// Insere no banco de dados
$query = "INSERT INTO alunos (rmalu, nomealu, emailalu, alusenha, pontmes, pontano, nometur) 
          VALUES ('$rmalu', '$nomealu', '$emailalu', '$alusenha_hash', 0, 0, '$nometur')";

if (mysqli_query($conexao, $query)) {
    echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar!']);
}

mysqli_close($conexao);
?>
