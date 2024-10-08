<?php
// Inicia a sessão
session_start();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou inicial
echo "<script>
                alert('Deslogando!');
                window.location.href = '../../FrontEnd/pagina_inicial.php';
              </script>";  // Altere "login.php" para a página de destino
exit();
