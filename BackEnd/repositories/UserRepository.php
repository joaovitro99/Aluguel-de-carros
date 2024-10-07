<?php

class UserRepository{

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function insertUser($nome,$senha,$tipo)
    {
        $sql= "INSERT INTO usuarios (nome_usuario, senha, tipo_usuario) VALUES (?, ?, ?)";

        $smt = $this->data_provider->prepare($sql);
        $smt ->bind_param("sss",$nome,$senha,$tipo);
        $smt->execute();



    }
    public function removeUser()
    {
        
    }
    public function updateUser()
    {
        
    }
    public function getUserLogin($nome_usuario, $senha){
        $sql_getUser = "SELECT id_usuario,nome_usuario, senha, tipo_usuario FROM usuarios WHERE nome_usuario = ? AND senha = ?";
        $stmt = $this->data_provider->prepare($sql_getUser);
        $stmt->bind_param("ss", $nome_usuario, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$result) {
            // Lidar com erro de consulta
            echo "<script>
            alert('Usuário incorreto');
            window.location.href = '../../FrontEnd/Login.php';
          </script>";
            exit();
        }
        
        $user = $result->fetch_assoc();
        
        if(!$user){
            
            echo "<script>
                alert('Senha incorreta');
                window.location.href = '../../FrontEnd/Login.php';
              </script>";
            exit();
        }
        if($user['senha'] != $senha) {
            // Lidar com erro de consulta
            echo "<script>
            alert('Senha incorreta');
            window.location.href = '../../FrontEnd/Login.php';
          </script>";
            exit();
        }
        return $user;

    }
    public function getAll()
    {
        
    }

}