<?php

class ClientRepository {

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    // Função para inserir um cliente e seu usuário correspondente
    public function insertClient($nome, $cpf, $email, $endereco, $telefone, $nome_usuario, $senha) {
        // Transação para garantir que as duas tabelas (clientes e usuarios) sejam atualizadas de forma consistente
        $this->data_provider->begin_transaction();

        try {
            // Inserindo o cliente na tabela `clientes`
            $sql_cliente = "INSERT INTO clientes (nome, cpf, email, endereco, telefone) VALUES (?, ?, ?, ?, ?)";
            $stmt_cliente = $this->data_provider->prepare($sql_cliente);
            $stmt_cliente->bind_param("sssss", $nome, $cpf, $email, $endereco, $telefone);
            $stmt_cliente->execute();

            // Pegando o último id_cliente inserido
            //$id_cliente = $this->data_provider->getInsertId();

            // Inserindo o usuário correspondente na tabela `usuarios`
            $sql_usuario = "INSERT INTO usuarios (nome_usuario, senha, tipo_usuario, email) VALUES (?, ?, 'cliente', ?)";
            $stmt_usuario = $this->data_provider->prepare($sql_usuario);
            $hashed_senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografando a senha
            $stmt_usuario->bind_param("sss", $nome_usuario, $hashed_senha, $email);
            $stmt_usuario->execute();

            // Commit na transação
            $this->data_provider->commit();

            //return $id_cliente;

        } catch (Exception $e) {
            // Rollback em caso de erro
            $this->data_provider->rollback();
            throw new Exception("Erro ao inserir o cliente: " . $e->getMessage());
        }
    }

    // Função para atualizar os dados de um cliente
    public function updateClient($id_cliente, $nome, $cpf, $email, $endereco, $telefone) {
        $sql = "UPDATE clientes SET nome = ?, cpf = ?, email = ?, endereco = ?, telefone = ? WHERE id_cliente = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("sssssi", $nome, $cpf, $email, $endereco, $telefone, $id_cliente);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            throw new Exception("Nenhuma alteração foi feita.");
        }
    }

    // Função para remover um cliente
    public function removeClient($id_cliente) {
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            throw new Exception("Erro ao remover cliente.");
        }
    }

    // Função para buscar um cliente específico
    public function getClient($nome_usuario) {
        $sql = "SELECT * FROM clientes WHERE $nome_usuario = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("s", $nome_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            throw new Exception("Cliente não encontrado.");
        }
    }
    // Função para buscar um cliente pelo email
    public function getClientByEmail($email) {
        $sql = "SELECT * FROM clientes WHERE email = ?";  // Substitui nome_usuario por email
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("s", $email);  // Usamos "s" para indicar que estamos esperando um valor do tipo string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();  // Retorna os dados do cliente
        } else {
            throw new Exception("Cliente não encontrado.");
        }
    }

    // Função para buscar um cliente pelo id
    public function getClientById($id_cliente) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = ?";  // Substitui o nome_usuario por id_cliente
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id_cliente);  // Usamos "i" para indicar que estamos esperando um valor inteiro
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            throw new Exception("Cliente não encontrado.");
        }
    }


    // Função para obter todos os clientes
    public function getAllClients() {
        $sql = "SELECT * FROM clientes";
        $result = $this->data_provider->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Nenhum cliente encontrado.");
        }
    }
}
