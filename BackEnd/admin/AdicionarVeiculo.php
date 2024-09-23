<?php

require(__DIR__."/../app/app.php");


$marca = '';
$modelo = '';
$ano = null;
$placa = '';
$valor_diaria = null;
$status = null;
$capacidade_pessoas=null;
$capacidade_bagageiro=null;
$cambio='';
$combustivel='';


$errors = [];
$status_bag;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (!empty($_POST['marca'])) {
        $marca = strtoupper(trim($_POST['marca']));
    } else {
        $errors[] = "A marca é obrigatória.";
    }

   
    if (!empty($_POST['modelo'])) {
        $modelo = trim($_POST['modelo']);
    } else {
        $errors[] = "O modelo é obrigatório.";
    }

  
    if (!empty($_POST['ano'])) {
        $ano = filter_var($_POST['ano'], FILTER_VALIDATE_INT);
        if (!$ano || $ano < 1886 || $ano > date('Y')) { 
            $errors[] = "Ano inválido.";
        }
    } else {
        $errors[] = "O ano é obrigatório.";
    }

    if (!empty($_POST['placa'])) {
        $placa = strtoupper(trim($_POST['placa']));
      
        if (!preg_match('/^[A-Z]{3}-?[0-9]{4}$/', $placa) && !preg_match('/^[A-Z]{3}[0-9][A-Z][0-9]{2}$/', $placa)) {
            $errors[] = "Placa inválida.";
        }
    } else {
        $errors[] = "A placa é obrigatória.";
    }

  
    if (!empty($_POST['valorDiaria'])) {
        $valor_diaria = filter_var($_POST['valorDiaria'], FILTER_VALIDATE_FLOAT);
        if (!$valor_diaria || $valor_diaria <= 0) {
            $errors[] = "Valor da diária inválido.";
        }
    } else {
        $errors[] = "O valor da diária é obrigatório.";
    }

    
    if (isset($_POST['status'])) {
        $status = (int)$_POST['status'];
        if ($status < 1 || $status > 3) {
            $errors[] = "Status inválido.";
        }
    } else {
        $errors[] = "O status é obrigatório.";
    }

    if (!empty($_POST['capacidade_pessoas'])) {
        $capacidade_pessoas= filter_var($_POST['capacidade_pessoas'],FILTER_VALIDATE_INT);
    } else {
        $errors[] = "Numero de passageiros inválido ou não informado";
    }

    if (!empty($_POST['capacidade_bagageiro'])) {
        $capacidade_bagageiro= filter_var($_POST['capacidade_bagageiro'],FILTER_VALIDATE_FLOAT);
    } else {
        $errors[] = "Capacidade do bagageiro inválida ou não informada";
    }

    if (!empty($_POST['cambio'])) {
        $cambio= $_POST['cambio'];
    } else {
        $errors[] = "Tipo de câmbio não informado";
    }

    if (!empty($_POST['combustivel'])) {
        $combustivel= $_POST['combustivel'];
    } else {
        $errors[] = "Tipo de combustivel não informado";
    }
   
    if (empty($errors)) {
        $car_repository->insertCar($marca,$modelo,$ano,$placa,$valor_diaria,$status,$capacidade_pessoas,$capacidade_bagageiro,$cambio,$combustivel);
        echo "<script>
            alert('Carro inserido com sucesso!');
            window.location.href = '../../FrontEnd/veiculos.php';
          </script>";
          exit(); 
    } 

    
}
?>
