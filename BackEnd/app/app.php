<?php


include("mySqlDataProvider.php");
include("UserRepository.php");
include("CarRepository.php");
include("config.php");

$data_provider= new MySqlDataProvider(CONFIG);
$user_repository= new UserRepository($data_provider);
$car_repository= new CarRepository($data_provider);
// .....

