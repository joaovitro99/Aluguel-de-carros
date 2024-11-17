<?php

class UserRepository {
    private $dataProvider;

    public function __construct($dataProvider) {
        $this->dataProvider = $dataProvider;
    }
    
    public function insertFuncionario($nome,$senha) {
        // Transação para garantir que as duas tabelas (clientes e usuarios) sejam atualizadas de forma consistente
        $this->dataProvider->begin_transaction();

        try {

            // Inserindo o usuário correspondente na tabela `usuarios`
            $sql_usuario = "INSERT INTO usuarios (nome_usuario, senha, tipo_usuario) VALUES (?, ?, 'funcionario')";
            $stmt_usuario = $this->dataProvider->prepare($sql_usuario);
            $hashed_senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografando a senha
            $stmt_usuario->bind_param("ss", $nome, $hashed_senha);
            $stmt_usuario->execute();

            // Commit na transação
            $this->dataProvider->commit();


        } catch (Exception $e) {
            // Rollback em caso de erro
            $this->dataProvider->rollback();
            throw new Exception("Erro ao inserir o funcionario: " . $e->getMessage());
        }
    }

    public function getAllUsuarios() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->dataProvider->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $usuarios = [];
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = new Usuario($row);
            }
            return $usuarios;
        }
        return [];
    }

    public function deleteUsuario($id) {
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $this->dataProvider->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id);
            return $stmt->execute();
        }
        return false;
    }
    /*
    public function getUserLogin($nome_usuario, $senha) {
        $sql = "SELECT id_usuario, tipo_usuario FROM usuarios WHERE nome_usuario = ? AND senha = ?";
        $stmt = $this->dataProvider->prepare($sql);
        $stmt->bind_param("ss", $nome_usuario, $senha);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    */
    
    public function getUserLogin($nome_usuario, $senha) {
        // Seleciona a senha criptografada do usuário, juntamente com o ID e o tipo de usuário
        $sql = "SELECT id_usuario, tipo_usuario, senha FROM usuarios WHERE nome_usuario = ?";
        $stmt = $this->dataProvider->prepare($sql);
        $stmt->bind_param("s", $nome_usuario);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
   
        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($user) {
            // Se o usuário é do tipo 'cliente', verifica a senha usando password_verify
            if ($user['tipo_usuario'] === 'cliente') {
                if (password_verify($senha, $user['senha'])) {
                    return [
                        'id_usuario' => $user['id_usuario'],
                        'tipo_usuario' => $user['tipo_usuario']
                    ];
                }
            } else {
                // Para 'admin' e 'funcionario', verifica a senha diretamente
                if ($senha === $user['senha']) {
                    return [
                        'id_usuario' => $user['id_usuario'],
                        'tipo_usuario' => $user['tipo_usuario']
                    ];
                }
            }
        } else {
            // Retorna null se o usuário não foi encontrado ou a senha está incorreta
            return null;
        }
    }

    public function updatePassword($token, $hashedPassword) {
        // busca o email associado ao token
        $sql = "SELECT c.email 
                FROM password_reset_tokens prt
                JOIN clientes c ON prt.email = c.email
                WHERE prt.token = ? AND prt.expiration > NOW() LIMIT 1";
        $stmt = $this->dataProvider->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Se o token for válido, atualizamos a senha na tabela usuarios
            $row = $result->fetch_assoc();
            $email = $row['email'];
    
            // Atualiza a senha do usuário
            $updateSql = "UPDATE usuarios SET senha = ? WHERE email = ?";
            $updateStmt = $this->dataProvider->prepare($updateSql);
            $updateStmt->bind_param("ss", $hashedPassword, $email);
            $updateStmt->execute();
        } else {
            throw new Exception("Token inválido ou expirado.");
        }
    }            

    public function saveResetToken($email, $token, $expiration) {
        $sql = "INSERT INTO password_reset_tokens (email, token, expiration) VALUES (?, ?, ?)";
        $stmt = $this->dataProvider->prepare($sql);
        $stmt->bind_param("sss", $email, $token, $expiration);
        $stmt->execute();
    }

    public function isValidToken($token) {
        $sql = "SELECT * FROM password_reset_tokens WHERE token = ? AND expiration > NOW() LIMIT 1";
        $stmt = $this->dataProvider->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result->num_rows > 0;
        }
        return false;
    }
    public function getUserByterm($term){
        $stmt = $this->dataProvider->prepare("SELECT * FROM clientes WHERE nome LIKE ? OR cpf LIKE ? OR email LIKE ?");
        $searchTerm = "%" . $term . "%";
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }
}
