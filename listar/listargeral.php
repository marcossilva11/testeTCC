<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte Cultural - Professores</title>
    <link rel="stylesheet" href="../css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:wght@400..900&family=PT+Serif:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('../img/classes.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-color 0.3s ease, background-image 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centraliza horizontalmente */
            min-height: 100vh; /* Garante que o corpo ocupe toda a altura da tela */
        }

        .menu {
            width: 100%;
            background-color: #402E7A;
            color: white;
            display: flex;
            justify-content: center; /* Centraliza horizontalmente o conteúdo do menu */
            padding: 10px 0; /* Adiciona padding superior e inferior */
            box-sizing: border-box; /* Inclui o padding na largura total do menu */
            position: fixed; /* Fixa o menu no topo da página */
            top: 0; /* Alinha o menu ao topo */
            left: 0; /* Alinha o menu à esquerda */
            z-index: 1000; /* Garante que o menu fique acima de outros conteúdos */
        }

        .menu a {
            color: white;
            text-decoration: none;
            padding: 0 15px;
            font-size: 18px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        /* Adiciona espaço adicional no topo do corpo para compensar a navegação fixa */
        .content {
            margin-top: 60px; /* Ajuste conforme necessário para o tamanho do menu */
        }

        table {
            width: 90%; /* Ajuste conforme necessário */
            max-width: 1200px; /* Define uma largura máxima */
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff9e;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #98af56;
            color: white;
        }

        caption {
            padding: 10px;
            font-size: 1.5em;
            font-weight: bold;
            background-color: #98af56;
            color: white;
        }

        @media (max-width: 768px) {
            body {
                background-color: #fde0a0;
                background-image: none;
                justify-content: center; /* Alinha verticalmente em dispositivos móveis */
                padding: 20px; /* Adiciona algum espaço interno */
            }

            .menu {
                padding: 10px 0; /* Garante que o padding não cause espaçamento indesejado */
                margin: 0; /* Remove margens se houver */
                position: fixed; /* Fixa o menu no topo da página */
                top: 0; /* Alinha o menu ao topo */
                left: 0; /* Alinha o menu à esquerda */
                width: 100%; /* Garante que o menu ocupe toda a largura da tela */
            }

            .content {
                margin-top: -60px; /* Ajuste conforme necessário para o tamanho do menu */
            }

            table {
                width: 100%; /* Aumenta a largura da tabela para ocupar toda a largura disponível */
                max-width: none; /* Remove a largura máxima em dispositivos móveis */
                margin: 20px 0; /* Adiciona margens verticais */
            }

            th, td {
                font-size: 16px; /* Aumenta o tamanho da fonte para melhorar a legibilidade */
                padding: 10px; /* Ajusta o padding */
            }

            caption {
                font-size: 1.4em; /* Ajusta o tamanho da fonte do caption */
            }
        }

        @media (min-width: 912px) and (max-width: 1368px) {

            .form-container {
                padding: 25px;
                max-width: 60%;
            }

            .form-container h2 {
                font-size: 28px;
            }

            .form-group input {
                padding: 10px;
                font-size: 18px;
            }

            .form-group input[type="submit"] {
                font-size: 18px;
                height: 40px;
            }
        }
    </style>
</head>
<body>

        <?php
            include "../php/conexao.php";
            $classe = $_GET['classe'];
            $query = mysqli_query($sql,"select * from alunos where NomeTu='$classe' ORDER BY Nome ASC;");
        ?>

    <nav class="menu">
        <a href="../index.html">Inicio</a>
    </nav><br><br><br><br><br><br>

    <table border="1">
<tr>
    <td align="center">RM</td>
    <td align="center">Nome</td>
    <td align="center">Email</td>
    <td align="center">Pontos</td>
    <td align="center" colspan="2">Ação</td>
</tr>

<?php
    while($row = mysqli_fetch_array($query)){
        $RmAlu = $row['RmAlu'];
        $Nome = $row['Nome'];
        $EmailAlu = $row['EmailAlu'];
        echo"
        <tr>
        <td>$RmAlu</td>
        <td>$Nome</td>
        <td>$EmailAlu</td>
        <td></td>
        <td><a href=\"editar.php?codigo=$RmAlu\">[Editar]</a></td>
        <td><a href=\"excluir.php?codigo=$RmAlu\">[Excluir]</a></td>
        </tr>";
    }
?>
</body>
</html>
