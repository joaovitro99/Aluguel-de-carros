<?php 
     $conexao= mysqli_connect("localhost", "root", "aluguel@carros5", "aluguelcarrobd");
    
     if ($conexao) {
         echo "Conexão bem-sucedida!";
     }
else{
    echo "deu pau";
}


mysqli_close($conexao);