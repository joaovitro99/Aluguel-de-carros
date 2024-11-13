<?php

class LogoutController {
    public function logout() {
        // Inicia a sessão
        

        // Destroi a sessão
        session_destroy();

        // Redireciona para a página de login ou inicial
        echo "<script>
            alert('Deslogando!');
            window.location.href = '/aluguel-de-carros/public/car/listar';
        </script>";
        exit();
    }
}
