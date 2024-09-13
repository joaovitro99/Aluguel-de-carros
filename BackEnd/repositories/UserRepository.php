<?php

class UserRepository{

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function insertUser($nome,$senha,$tipo)
    {
        $sql= "INSERT INTO usuarios (nome_usuario, senha, tipo_usuario) VALUES (?, ?, ?)";

        $smt = $this->data_provider->prepare($sql);
        $smt ->bind_param("sss",$nome,$senha,$tipo);
        $smt->execute();



    }
    public function removeUser()
    {
        
    }
    public function updateUser()
    {
        
    }
    public function getUser(){

    }
    public function getAll()
    {
        
    }

}