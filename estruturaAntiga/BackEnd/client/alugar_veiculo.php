<?php
include("mySqlDataProvider.php");
include("UserRepository.php");
include("CarRepository.php");
include("config.php");

$sql = "SELECT marca, modelo, ano,valor_diaria FROM veiculos WHERE status = 'disponível' ";
$result = $conexao->query($sql);
