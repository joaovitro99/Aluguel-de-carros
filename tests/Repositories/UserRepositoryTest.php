<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/repositories/UserRepository.php';

class UserRepositoryTest extends TestCase {
    private $mockDataProvider;
    private $userRepository;

    protected function setUp(): void {
        $this->mockDataProvider = $this->createMock(mysqli::class);
        $this->userRepository = new UserRepository($this->mockDataProvider);
    }

    public function testInsertFuncionarioSuccess() {
        $nome = "Test User";
        $senha = "password123";

        $this->mockDataProvider
            ->expects($this->once())
            ->method('begin_transaction');

        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock
            ->expects($this->once())
            ->method('bind_param')
            ->with("ss", $nome, $this->callback(function ($hashedPassword) use ($senha) {
                return password_verify($senha, $hashedPassword);
            }));

        $stmtMock
            ->expects($this->once())
            ->method('execute');

        $this->mockDataProvider
            ->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("INSERT INTO usuarios"))
            ->willReturn($stmtMock);

        $this->mockDataProvider
            ->expects($this->once())
            ->method('commit');

        $this->userRepository->insertFuncionario($nome, $senha);
    }

    public function testInsertFuncionarioThrowsExceptionOnError() {
        $this->mockDataProvider
            ->expects($this->once())
            ->method('begin_transaction');

        $this->mockDataProvider
            ->expects($this->once())
            ->method('prepare')
            ->will($this->throwException(new Exception("Mocked error")));

        $this->mockDataProvider
            ->expects($this->once())
            ->method('rollback');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Erro ao inserir o funcionario");

        $this->userRepository->insertFuncionario("Test User", "password123");
    }

    public function testDeleteUsuarioSuccess() {
        $id = 1;

        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock
            ->expects($this->once())
            ->method('bind_param')
            ->with('i', $id);
        $stmtMock
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockDataProvider
            ->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("DELETE FROM clientes WHERE id_cliente"))
            ->willReturn($stmtMock);

        $result = $this->userRepository->deleteUsuario($id);

        $this->assertTrue($result);
    }

}