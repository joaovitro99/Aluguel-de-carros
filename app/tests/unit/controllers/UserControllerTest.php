<?php

use PHPUnit\Framework\TestCase;
use App\Repositories\UserRepository;
use App\Controllers\UserController;

class UserControllerTest extends TestCase {

    private $userController;
    private $mockUserRepository;

    protected function setUp(): void {
        $this->mockUserRepository = $this->createMock(UserRepository::class);
       // $this->userController = new UserController();
        
        // Substitui o repositório real pelo mock
        //$this->userController->userRepository = $this->mockUserRepository;
    }

    public function testIndex() {
        // Definindo que o repositório de usuários deve retornar um array simulado
        $this->mockUserRepository->method('getAllUsuarios')->willReturn([]);

        // Captura a saída da função index
        ob_start();
        $this->userController->index();
        $output = ob_get_clean();

        // Verifica se a view 'usuarios.php' foi chamada corretamente
        $this->assertStringContainsString('usuarios.php', $output);
    }
}
