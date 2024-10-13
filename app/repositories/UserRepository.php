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
        $sql_login = "SELECT senha FROM usuarios WHERE nome_usuario = ?";
        $stmt_login = $this->data_provider->prepare($sql_login);
        $stmt_login->bind_param("s", $nome_usuario);
        $stmt_login->execute();
        $result_login = $stmt_login->get_result();
        $row = '';
        
        if ($result_login->num_rows > 0) {
            $row = $result_login->fetch_assoc();
            $hashed_senha = $row['senha'];
        
            // Verifica a senha
            if (password_verify($senha, $hashed_senha)) {
                // Senha correta
                return $row;
                
            } else {
                // Senha incorreta
                echo "<script>
                    alert('senha incorreta')
                    window.location.href = '../../FrontEnd/Login.php';
                  </script>";
                  exit();
            }
        } else {
            // Usuário não encontrado
            echo "<script>
                    alert('Usuario incorreto')
                    window.location.href = '../../FrontEnd/Login.php';
                  </script>";
                  exit();
        }
        
        

        
       

    }
    public function getAll()
    {
        
    }

}