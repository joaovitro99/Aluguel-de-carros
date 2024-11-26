<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

require_once __DIR__ . '/../../app/controllers/LoginController.php';
require_once __DIR__ . '/../../app/repositories/UserRepository.php';

class LoginControllerTest extends TestCase {
    /**
     * @var UserRepository|MockObject
     */
    private $mockUserRepository;

    /**
     * @var LoginController
     */
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
        // Mock do método getUserLogin para retornar um cliente válido
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

        // Capturar saída do método
        ob_start();
        $this->loginController->verificarLogin();
        $output = ob_get_clean();

        // Verifica se o redirecionamento para o perfil do cliente ocorreu
        $this->assertStringContainsString("window.location.href = '/aluguel-de-carros/public/user/showProfile';", $output);
    }

    public function testVerificarLoginFailInvalidCredentials() {
        // Mock do método getUserLogin para retornar null (login inválido)
        $this->mockUserRepository
            ->expects($this->once())
            ->method('getUserLogin')
            ->with('joao', 'wrongpassword')
            ->willReturn(null);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nome_usuario'] = 'joao';
        $_POST['senha'] = 'wrongpassword';

        // Capturar saída do método
        ob_start();
        $this->loginController->verificarLogin();
        $output = ob_get_clean();

        // Verifica se o alerta de credenciais incorretas foi exibido
        $this->assertStringContainsString("alert('Usuário ou senha incorretos');", $output);
    }

    public function testVerificarLoginWithMissingFields() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['nome_usuario'] = '';
        $_POST['senha'] = '';

        // Capturar saída do método
        ob_start();
        $this->loginController->verificarLogin();
        $output = ob_get_clean();

        // Verifica se os alertas de campos obrigatórios foram exibidos
        $this->assertStringContainsString("alert('O nome de usuário é obrigatório.');", $output);
    }
}
