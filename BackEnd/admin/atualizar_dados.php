<?php

// Inclui a classe de conexão e o arquivo de configuração
include(__DIR__."/"."../data/MySqlDataProvider.php");
include(__DIR__."/"."../app/config.php");

$conn = new MySqlDataProvider($config);

// Função para exibir mensagens de erro
function exibirMensagemErro($mensagem) {
    echo "<p style='color:red;'>Erro: $mensagem</p>";
    echo "<a href='../../FrontEnd/veiculos.php'>Voltar para a lista de veículos</a>";
    exit;
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_veiculo = $_POST['id_veiculo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $status = $_POST['status'];
    $valor_diaria = $_POST['valor_diaria'];
    $cambio = $_POST['cambio'];
    $capacidade_bagageiro = $_POST['capacidade_bagageiro'];
    $capacidade_pessoas = $_POST['capacidade_pessoas'];
    $combustivel = $_POST['combustivel'];

    // Inicia uma flag para rastrear se tudo deu certo
    $atualizacaoSucesso = true;

    // Atualiza as informações do veículo
    $sql = "UPDATE veiculos SET marca = ?, modelo = ?, ano = ?, placa = ?, status = ?, valor_diaria = ?, cambio = ?, capacidade_bagageiro = ?, capacidade_pessoas = ?, combustivel = ? WHERE id_veiculo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssiiii", $marca, $modelo, $ano, $placa, $status, $valor_diaria, $cambio, $capacidade_bagageiro, $capacidade_pessoas, $combustivel, $id_veiculo);

    if (!$stmt->execute()) {
        $atualizacaoSucesso = false; // Marca como falha
        exibirMensagemErro("Erro ao atualizar as informações: " . $stmt->error);
    }
    $stmt->close();

    // Verifica se o arquivo de imagem foi enviado e processa o upload
    if (isset($_FILES['imagem_veiculo']) && $_FILES['imagem_veiculo']['error'] === UPLOAD_ERR_OK) {
        
        // Diretório onde a imagem será salva
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['imagem_veiculo']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Movendo o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES['imagem_veiculo']['tmp_name'], $uploadFile)) {
            
            // Atualiza o banco de dados com o novo caminho da imagem
            $sql_update_image = "UPDATE imagens_veiculo SET imagem = ? WHERE id_veiculo = ? AND id_imagem = ?";
            $stmt_update = $conn->prepare($sql_update_image);
            $stmt_update->bind_param('si', $uploadFile, $id_veiculo,$id_imagem);

            if (!$stmt_update->execute()) {
                $atualizacaoSucesso = false; // Marca como falha
                exibirMensagemErro("Erro ao atualizar a imagem no banco de dados.");
            }
            $stmt_update->close();
        } else {
            $atualizacaoSucesso = false; // Marca como falha
            exibirMensagemErro("Erro ao fazer upload da imagem.");
        }
    }

    // Verifica se todas as operações foram bem-sucedidas
    if ($atualizacaoSucesso) {
        echo "<p style='color:green;'>Informações do veículo e imagem atualizadas com sucesso!</p>";
        echo "<a href='../../FrontEnd/veiculos.php'>Voltar para a lista de veículos</a>";
    }
} else {
    exibirMensagemErro("Método de requisição inválido.");
}
?>




