<?php

require("../app/app.php");


$marca;
$modelo;
$ano;
$placa;
$valor_diaria;
$status;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    $marca =$_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = filter_var($_POST['ano'],FILTER_VALIDATE_INT);
    $placa = $_POST['placa'];
    $valor_diaria=$_POST['valorDiaria'];
    $status= (int)$_POST['status'];

}

#validar


$car_repository->insertCar($marca,$modelo,$ano,$placa,$valor_diaria,$status);

    echo '<h1>Carro inserido!</h1>';
    echo $status;

