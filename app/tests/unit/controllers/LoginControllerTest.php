<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\LoginController;
use App\Repositories\UserRepository;

class LoginControllerTest extends TestCase {
    private $loginController;
    private $userRepositoryMock;

    protected function setUp(): void {
        // Inicializa $_SESSION
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Criar um mock para UserRepository
        $this->userRepositoryMock = $this->createMock(UserRepository::class);

        // Instanciar LoginController com o mock
        $this->loginController = new LoginController();
        //$this->loginController->userRepository = $this->userRepositoryMock;
    }

    /** @runInSeparateProcess */
    public function testIndexMethodRendersLoginView() {
        $this->expectOutputRegex('/Login/'); // Verifica se "Login" está no conteúdo gerado
        $this->loginController->index();
    }

    /** @runInSeparateProcess */
    public function testVerificarLoginWithValidUser() {
        // Simular um usuário válido retornado pelo UserRepository
        $this->userRepositoryMock->method('getUserLogin')
            ->with('valid_user', 'valid_password')
            ->willReturn([
                'id_usuario' => 1,
                'tipo_usuario' => 'cliente',
            ]);

        // Configurar $_POST
        $_POST['nome_usuario'] = 'valid_user';
        $_POST['senha'] = 'valid_password';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        // Capturar saída do método
        $this->expectOutputRegex('/Login feito com sucesso/');

        // Executar método
        $this->loginController->verificarLogin();

        // Verificar sessão
        $this->assertEquals(1, $_SESSION['id_usuario']);
        $this->assertEquals('cliente', $_SESSION['user']['tipo_usuario']);
    }

    /** @runInSeparateProcess */
    public function testVerificarLoginWithInvalidUser() {
        // Simular um retorno nulo do UserRepository para um login inválido
        $this->userRepositoryMock->method('getUserLogin')
            ->willReturn(null);

        // Configurar $_POST
        $_POST['nome_usuario'] = 'invalid_user';
        $_POST['senha'] = 'invalid_password';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        // Capturar saída do método
        $this->expectOutputRegex('/Usuário ou senha incorretos/');

        // Executar método
        $this->loginController->verificarLogin();
    }

    /** @runInSeparateProcess */
    public function testVerificarLoginWithValidationErrors() {
        // Configurar $_POST com campos vazios
        $_POST['nome_usuario'] = '';
        $_POST['senha'] = '';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        // Capturar saída do método
        $this->expectOutputRegex('/O nome de usuário é obrigatório/');

        // Executar método
        $this->loginController->verificarLogin();
    }
}
