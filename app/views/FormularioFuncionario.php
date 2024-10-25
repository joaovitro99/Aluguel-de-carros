<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alucarros - Formulário de Cadastro</title>
    <link rel="stylesheet" href="../../public/assets/css/cadastrados.css" />
</head>
<body>

   
    <div class="container">
        <div class="form-box">
            <a href="#" class="back-arrow">←</a>
            <h1 class="title">Cadastro de Funcionario</h1>

            <!-- Note que o action está direcionando para o Controller -->
            <form action="../controllers/FuncionarioController.php" method="post">
                <label for="nome_usuario">Nome do Funcionário:</label>
                <input type="text" id="nome_usuario" name="nome_usuario" 
                       placeholder="Nome de Usuário..." 
                       pattern=".{8,}" 
                       title="O nome de usuário deve ter pelo menos 8 caracteres." 
                       required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" 
                       placeholder="Senha..." 
                       pattern="(?=.*\d).{8,}" 
                       title="A senha deve ter pelo menos 8 caracteres e conter pelo menos um número." 
                       required>


                <button type="submit" class="submit-btn">Finalizar</button>
            </form>
        </div>
    </div>
</body>
</html>