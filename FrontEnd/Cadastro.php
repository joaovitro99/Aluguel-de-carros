<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alucarros - Formulário de Cadastro</title>
    <link rel="stylesheet"  href="assets/css/cadastrados.css" />
</head>
<body>

    <div class="retangulo-azul">
        <a href="#" class="home">Home</a>
        <a href="#" class="nossos-veiculos">Nossos Veículos</a>
        <a href="#" class="sobre-nos">Sobre Nós</a>
    </div>
   

    <div class="container">
        <div class="form-box">
            <a href="#" class="back-arrow">←</a>
            <h1 class="title">Cadastro</h1>
            <form action="../BackEnd/app/processar_dados.php" method="post">
            
                    <label for="nome_usuario">Nome de Usuário:</label>
                    <input type="text" id="nome_usuario" name="nome_usuario" placeholder="Nome de Usuário..." required>

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Senha..." required>

                  

                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome Completo..." required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email..." required>

                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="CPF..." pattern="\d{11}" title="Insira um CPF válido com 11 dígitos" required>

                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Endereço..." required>

                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone..." pattern="\d{10,11}" title="Insira um telefone válido com 10 ou 11 dígitos" required>

        
                <button type="submit" class="submit-btn">Finalizar</button>
            </form>
        </div>
    </div>
</body>
</html>
