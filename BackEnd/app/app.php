<?php

define('APP_NAME',dirname(__FILE__).'/');

include(APP_NAME."../data/mySqlDataProvider.php");
include(APP_NAME."../repositories/UserRepository.php");
include(APP_NAME."../repositories/CarRepository.php");
include("config.php");


$data_provider= new MySqlDataProvider(CONFIG);
$user_repository= new UserRepository($data_provider);
$car_repository= new CarRepository($data_provider);
// .....
