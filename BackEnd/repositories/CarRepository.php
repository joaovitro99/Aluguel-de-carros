<?php

class CarRepository{

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function insertCar($marca,$modelo,$ano,$placa,$valor_diaria,$status,$capacidade_pessoas,$capacidade_bagageiro,$cambio,$combustivel)
    {
        $sql= "INSERT INTO veiculos (marca, modelo, ano,placa,valor_diaria,status,capacidade_pessoas,capacidade_bagageiro,cambio,combustivel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

        $smt = $this->data_provider->prepare($sql);
        $smt ->bind_param("ssisdiidss",$marca,$modelo,$ano,$placa,$valor_diaria,$status,$capacidade_pessoas,$capacidade_bagageiro,$cambio,$combustivel);
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