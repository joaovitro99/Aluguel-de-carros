<?php

class Usuario {
    public $id;
    public $nome;
    public $cpf;
    public $endereco;
    public $telefone;
    public $email;

    public function __construct($data) {
        $this->id = $data['id_cliente'];
        $this->nome = $data['nome'];
        $this->cpf = $data['cpf'];
        $this->endereco = $data['endereco'];
        $this->telefone = $data['telefone'];
        $this->email = $data['email'];
    }
}
