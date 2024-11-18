<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Usuario.php';

class UsuarioTest extends TestCase {

    public function testUsuarioInitialization() {
        // Dados de entrada para o usuário
        $data = [
            'id_cliente' => 1,
            'nome' => 'John Doe',
            'cpf' => '123.456.789-00',
            'endereco' => 'Rua Exemplo, 123',
            'telefone' => '(11) 99999-9999',
            'email' => 'john.doe@example.com'
        ];

        // Criando o objeto Usuario com os dados fornecidos
        $usuario = new Usuario($data);

        // Testando se o objeto foi inicializado corretamente
        $this->assertEquals(1, $usuario->id);
        $this->assertEquals('John Doe', $usuario->nome);
        $this->assertEquals('123.456.789-00', $usuario->cpf);
        $this->assertEquals('Rua Exemplo, 123', $usuario->endereco);
        $this->assertEquals('(11) 99999-9999', $usuario->telefone);
        $this->assertEquals('john.doe@example.com', $usuario->email);
    } 
}
