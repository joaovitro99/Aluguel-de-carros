<?php

class Client {
    public $nome_usuario;
    public $senha;
    public $nome;
    public $cpf;
    public $email;
    public $endereco;
    public $telefone;

    public function __construct($nome_usuario, $senha, $nome, $cpf, $email, $endereco, $telefone) {
        $this->nome_usuario = $nome_usuario;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
    }
}