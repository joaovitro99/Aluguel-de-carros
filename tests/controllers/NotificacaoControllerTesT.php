<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/controllers/NotificacaoController.php';
require_once __DIR__ . '/../../app/repositories/NotificacaoRepository.php';

class NotificacaoControllerTest extends TestCase {
    private $mockNotificationRepository;
    private $notificacaoController;

    protected function setUp(): void {
        $this->mockNotificationRepository = $this->createMock(NotificacaoController::class);

    
        global $db_conection;
        $db_conection = $this->getMockBuilder(stdClass::class)->getMock();

      
        $this->notificacaoController = new NotificacaoController();
    }

    public function testIndexRendersView() {
        // Inicia o buffer para capturar a saída da view
        ob_start();
        $this->notificacaoController->index();
        $output = ob_get_clean();

        // Verifica se a view NotificacaoUsuario foi renderizada
        $this->assertStringContainsString('<html>', $output); // Substitua '<html>' por qualquer conteúdo esperado da view
    }

    public function testListarNotificacoesCallsRepositoryAndRendersView() {
        $mockNotificacoes = [
            ['id' => 1, 'titulo' => 'Notificação 1', 'mensagem' => 'Mensagem 1'],
            ['id' => 2, 'titulo' => 'Notificação 2', 'mensagem' => 'Mensagem 2'],
        ];

        $this->mockNotificationRepository
            ->expects($this->once())
            ->method('getByClientId')
            ->with($this->equalTo(123))
            ->willReturn($mockNotificacoes);

    
        ob_start();
        $this->notificacaoController->listarNotificacoes(123);
        $output = ob_get_clean();


        $this->assertStringContainsString('Notificação 1', $output);
        $this->assertStringContainsString('Notificação 2', $output);
    }
}