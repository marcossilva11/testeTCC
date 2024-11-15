<?php
session_start();
// Conexão com o banco de dados
include 'conexao.php';

// Receber dados do formulário
$rm = $_POST['rm'] ?? '';
$senha = $_POST['senha'] ?? '';

// Mensagens de erro
$errorRm = '';
$errorSenha = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Preparar a consulta
  $sql = "SELECT rmprof, profsenha, nomeprof FROM professor WHERE rmprof = ?";
  $stmt = $conexao->prepare($sql);

  if ($stmt) {
    // Bind dos parâmetros
    $stmt->bind_param("i", $rm);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado
    $stmt->bind_result($rmprof, $profsenha, $nomeprof);
    $stmt->fetch();

    // Verificar se a consulta retornou algum resultado
    if ($rmprof) {
      // Verificar se a senha está correta
      if (password_verify($senha, $profsenha)) {
        // Caso as senhas no banco estejam criptografadas
        $_SESSION['rmprof'] = $rmprof;
        header("Location: ../index.php");
        exit();
      } elseif ($senha === $profsenha) {
        // Caso as senhas não estejam criptografadas (comparação simples)
        $_SESSION['rmprof'] = $rmprof;
        $_SESSION['nomeprof'] = $nomeprof;
        header("Location: ../index.php");
        exit();
      } else {
        $errorSenha = "Senha incorreta!";
      }
    } else {
      $errorRm = "RM não encontrado!";
    }

    // Fechar a declaração
    $stmt->close();
  } else {
    echo "Erro na preparação da consulta: " . $conexao->error;
  }
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Professores</title>
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
  <!-- HEADER -->
  <nav class="navbar navbar-custom navbar-expand-lg border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1 titleLogin">Passaporte Cultural</span>
    </div>
  </nav>
  <!-- FIM HEADER -->

  <!-- MAIN -->
  <main class="form-signin container-lg m-auto d-flex flex-column justify-content-center px-4 h-75">
    <form action="" method="post">
      <h1 class="h3 mb-3 fw-normal">Login</h1>

      <div class="mb-3 inputGroup">
        <label for="inputRM">RM</label>
        <input type="text" class="form-control" id="inputRM" name="rm" placeholder="Your RM" value="<?= htmlspecialchars($rm) ?>" />
        <?php if ($errorRm): ?>
          <div class="text-danger"><?= $errorRm ?></div>
        <?php endif; ?>
      </div>
      <div class="mb-3 inputGroup">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="senha" placeholder="Password" />
        <?php if ($errorSenha): ?>
          <div class="text-danger"><?= $errorSenha ?></div>
        <?php endif; ?>
      </div>

      <div class="form-check text-start my-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start">
          <div class="d-flex align-items-center mb-3 mb-md-0">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label ms-2" for="flexCheckDefault">
              <span>Lembre-me</span>
            </label>
          </div>
          <p class="mb-0 mb-md-0 mt-3 mt-md-0">
            <a href="cadastro.php" class="link-offset-2 link-offset-3-hover link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
              Primeira vez? Clique aqui para realizar seu Cadastro
            </a>
          </p>
        </div>
      </div>
      <button class="btn btn-primary w-100 py-2 buttonCustom" type="submit">
        Entrar
      </button>
    </form>
  </main>
  <!-- FIM MAIN -->

  <!-- FOOTER -->
  <div class="container">
    <footer class="d-flex flex-wrap justify-content-center align-items-center py-1 border-top border-dark">
      <div class="col-md-12 text-center">
        <span class="mb-3 mb-md-0 text-secondary-emphasis">
          © 2024 Bunny Boys, Inc
        </span>
      </div>
    </footer>
  </div>
  <!-- FIM FOOTER -->

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>