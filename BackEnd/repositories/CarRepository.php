<?php

class CarRepository{

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function insertCar($marca,$modelo,$ano,$placa,$valor_diaria,$status)
    {
        $sql= "INSERT INTO veiculos (marca, modelo, ano,placa,valor_diaria,status) VALUES (?, ?, ?, ?, ?, ?)";

        $smt = $this->data_provider->prepare($sql);
        $smt ->bind_param("ssisdi",$marca,$modelo,$ano,$placa,$valor_diaria,$status);
        $smt->execute();



    }
    public function removeCar()
    {
        
    }
    public function updateCar()
    {
        
    }
    public function getCar(){

    }
    public function getAll()
    {
        
    }

}