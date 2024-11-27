<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

require_once __DIR__ . '/../../app/controllers/LoginController.php';
require_once __DIR__ . '/../../app/repositories/UserRepository.php';

class LoginControllerTest extends TestCase {
    private $mockUserRepository;
    private $loginController;

    protected function setUp(): void {
        $this->mockUserRepository = $this->createMock(UserRepository::class);
        $this->loginController = new LoginController();

        // Injetando o mock no LoginController
        $reflection = new ReflectionClass(LoginController::class);
        $property = $reflection->getProperty('userRepository');
        $property->setAccessible(true);
        $property->setValue($this->loginController, $this->mockUserRepository);
    }

    public function testVerificarLoginSuccessForCliente() {
        $mockUser = [
            'id_usuario' => 1,
            'tipo_usuario' => 'cliente',
            'nome_usuario' => 'joao',
        ];

        $this->mockUserRepository
            ->expects($this->once())
            ->method('getUserLogin')
            ->with('joao', '12345')
            ->willReturn($mockUser);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nome_usuario'] = 'joao';
        $_POST['senha'] = '12345';

        $result = $this->loginController->verificarLogin();

        $this->assertEquals('success', $result['status']);
        $this->assertEquals('/aluguel-de-carros/public/user/showProfile', $result['redirect']);
    }

    public function testVerificarLoginFailInvalidCredentials() {
        $this->mockUserRepository
            ->expects($this->once())
            ->method('getUserLogin')
            ->with('joao', 'wrongpassword')
            ->willReturn(null);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nome_usuario'] = 'joao';
        $_POST['senha'] = 'wrongpassword';

        $result = $this->loginController->verificarLogin();

        $this->assertEquals('error', $result['status']);
        $this->assertContains('Usuário ou senha incorretos', $result['errors']);
    }

    public function testVerificarLoginWithMissingFields() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nome_usuario'] = '';
        $_POST['senha'] = '';

        $result = $this->loginController->verificarLogin();

        $this->assertEquals('error', $result['status']);
        $this->assertContains('O nome de usuário é obrigatório.', $result['errors']);
        $this->assertContains('A senha é obrigatória.', $result['errors']);
    }
}