<?php

use PHPUnit\Framework\TestCase;
//use App\repositories\UserRepository;
require_once __DIR__ . '/../../app/repositories/UserRepository.php';

class UserRepositoryTest extends TestCase {

    private $dataProviderMock;
    private $userRepository;

    protected function setUp(): void {
        // Criação do mock para o data_provider
        $this->dataProviderMock = $this->createMock(mysqli::class);
        // Inicializando o repositório
        $this->userRepository = new UserRepository($this->dataProviderMock);
    }

    // Teste para a função insertFuncionario
    public function testInsertFuncionario() {
        // Dados de entrada
        $nome = 'Funcionario Teste';
        $senha = 'senha123';

        // Definindo o comportamento esperado do mock
        $this->dataProviderMock->expects($this->once())
            ->method('begin_transaction');
        $this->dataProviderMock->expects($this->once())
            ->method('prepare')
            ->willReturn($this->createMock(mysqli_stmt::class));
        $this->dataProviderMock->expects($this->once())
            ->method('commit');
        
        // Chama o método que está sendo testado
        $this->userRepository->insertFuncionario($nome, $senha);
        
        // Nenhum erro deve ser lançado, se o teste passar corretamente
        $this->assertTrue(true);
    }

    // Teste para a função getAllUsuarios
    public function testGetAllUsuarios() {
        // Mock para simular o resultado da consulta
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute');
        
        // Corrigindo a falha com a criação do mock de mysqli_result
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('fetch_all')->willReturn([['id' => 1, 'nome' => 'Funcionario Teste']]);
        $stmtMock->method('get_result')->willReturn($resultMock);

        // Simulando o comportamento do método prepare
        $this->dataProviderMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Chama o método que está sendo testado
        $usuarios = $this->userRepository->getAllUsuarios();
        
        // Verificando se o retorno é um array
        $this->assertIsArray($usuarios);
        $this->assertCount(1, $usuarios);
    }

    // Teste para a função deleteUsuario
    public function testDeleteUsuario() {
        $id = 1;

        // Mock para simular a execução da query
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('bind_param');
        $stmtMock->method('execute')->willReturn(true);

        // Simulando o comportamento do método prepare
        $this->dataProviderMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Chamando o método que realiza a exclusão
        $result = $this->userRepository->deleteUsuario($id);
        
        // Verificando se a exclusão foi realizada com sucesso
        $this->assertTrue($result);
    }

    // Teste para a função getUserLogin (senha correta)
    public function testGetUserLoginSuccess() {
        $nome_usuario = 'usuarioTeste';
        $senha = 'senha123';

        // Simulando a consulta do banco de dados com senha criptografada
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('bind_param');
        $stmtMock->method('execute');
        
        // Mock de dados com um resultado fictício
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('fetch_assoc')->willReturn(['id' => 1, 'nome_usuario' => 'usuarioTeste', 'senha' => 'senha123']);
        $stmtMock->method('get_result')->willReturn($resultMock);

        // Esperando o comportamento do prepare
        $this->dataProviderMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Verificando o retorno com sucesso
        $result = $this->userRepository->getUserLogin($nome_usuario, $senha);
        $this->assertNotNull($result);
        $this->assertEquals('usuarioTeste', $result['nome_usuario']);
    }

    // Teste para a função updatePassword (token inválido)
    public function testUpdatePasswordInvalidToken() {
        $token = 'invalid_token';
        $nova_senha = 'novaSenha123';

        // Simulando que o token não existe
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('bind_param');
        $stmtMock->method('execute')->willReturn(false);

        // Simulando o comportamento do método prepare
        $this->dataProviderMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Chamando o método que tenta atualizar a senha com um token inválido
        $result = $this->userRepository->updatePassword($token, $nova_senha);

        // Verificando se o resultado é falso
        $this->assertFalse($result);
    }

    // Teste para a função updatePassword (token válido)
    public function testUpdatePasswordValidToken() {
        $token = 'valid_token';
        $nova_senha = 'novaSenha123';

        // Simulando que o token existe e a senha foi atualizada
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('bind_param');
        $stmtMock->method('execute')->willReturn(true);

        // Simulando o comportamento do método prepare
        $this->dataProviderMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        // Chamando o método que tenta atualizar a senha com um token válido
        $result = $this->userRepository->updatePassword($token, $nova_senha);

        // Verificando se o resultado é verdadeiro
        $this->assertTrue($result);
    }
}
