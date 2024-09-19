<?php


include("../data/mySqlDataProvider.php");
include("../repositories/UserRepository.php");
include("../repositories/CarRepository.php");
include("config.php");

$data_provider= new MySqlDataProvider($config);
$user_repository= new UserRepository($data_provider);
$car_repository= new CarRepository($data_provider);
// .....

