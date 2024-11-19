<?php

use PHPUnit\Framework\TestCase;
//use App\Models\Cliente;
require_once __DIR__ . '/../../app/models/Cliente.php';

class ClienteTest extends TestCase {

    public function testClientInitialization() {
        // Dados de entrada para o cliente
        $data = [
            'nome_usuario' => 'johndoe',
            'senha' => 'securepassword123',
            'nome' => 'John Doe',
            'cpf' => '123.456.789-00',
            'email' => 'john.doe@example.com',
            'endereco' => 'Rua Exemplo, 123',
            'telefone' => '(11) 99999-9999'
        ];

        // Criando o objeto Client com os dados fornecidos
        $client = new Client(
            $data['nome_usuario'], 
            $data['senha'], 
            $data['nome'], 
            $data['cpf'], 
            $data['email'], 
            $data['endereco'], 
            $data['telefone']
        );

        // Testando se o objeto foi inicializado corretamente
        $this->assertEquals('johndoe', $client->nome_usuario);
        $this->assertEquals('securepassword123', $client->senha);
        $this->assertEquals('John Doe', $client->nome);
        $this->assertEquals('123.456.789-00', $client->cpf);
        $this->assertEquals('john.doe@example.com', $client->email);
        $this->assertEquals('Rua Exemplo, 123', $client->endereco);
        $this->assertEquals('(11) 99999-9999', $client->telefone);
    }

    public function testClientInitializationWithMissingData() {
        // Dados de entrada incompletos (faltando alguns dados como telefone)
        $data = [
            'nome_usuario' => 'janedoe',
            'senha' => 'password456',
            'nome' => 'Jane Doe',
            'cpf' => '987.654.321-00',
            'email' => 'jane.doe@example.com',
            'endereco' => 'Rua Exemplo, 456',
            'telefone' => ''
        ];

        // Criando o objeto Client com dados parciais
        $client = new Client(
            $data['nome_usuario'], 
            $data['senha'], 
            $data['nome'], 
            $data['cpf'], 
            $data['email'], 
            $data['endereco'], 
            $data['telefone']
        );

        // Testando se o objeto foi inicializado corretamente, com o telefone vazio
        $this->assertEquals('janedoe', $client->nome_usuario);
        $this->assertEquals('password456', $client->senha);
        $this->assertEquals('Jane Doe', $client->nome);
        $this->assertEquals('987.654.321-00', $client->cpf);
        $this->assertEquals('jane.doe@example.com', $client->email);
        $this->assertEquals('Rua Exemplo, 456', $client->endereco);
        $this->assertEquals('', $client->telefone); // O telefone está vazio
    }
}
