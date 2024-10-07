<?php
session_start();
require(__DIR__."/../app/app.php");

$nome_usuario = '';
$senha = '';
$errors = [];
$status_bag;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (!empty($_POST['nome_usuario'])) {
        $nome_usuario = trim($_POST['nome_usuario']);
    } else {
        $errors[] = "O nome de usuário é obrigatório.";
    }

    if (!empty($_POST['senha'])) {
        $senha = trim($_POST['senha']);
    } else {
        $errors[] = "A senha é obrigatória.";
    }

    if (empty($errors)) {
        $user = $user_repository->getUserLogin($nome_usuario, $senha);
        $_SESSION['id_usuario'] = $user['id_usuario'];
        
        if ($user) {
            $direcao = '';
            if ($user['tipo_usuario'] == 'cliente') {
                $direcao = '../../FrontEnd/perfil.php';
            } else {
                $direcao = '../../FrontEnd/veiculos.php';
            }
            echo "<script>
                alert('Login feito com sucesso!');
                window.location.href = '$direcao';
              </script>";
            exit();
        } else {
            echo "<script>alert('Usuário ou senha incorretos');</script>";
        }
    } else {
        // Exibir erros
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }





// Redirecionar para o próximo arquivo
header('Location: ../../FrontEnd/perfil.php');
exit();
}