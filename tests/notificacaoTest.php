<?php
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase {
    private $mockDataProvider;
    private $notification;

    protected function setUp(): void {
        // Cria um mock do banco de dados
        $this->mockDataProvider = $this->createMock(mysqli::class);
        $this->notification = new Notification($this->mockDataProvider);
    }

    public function testEnviarNotificacaoBD() {
        // Mock do método prepare
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockDataProvider->method('prepare')->willReturn($mockStmt);
    
        // Mockando bind_param e execute
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);
    
        // Chamando o método e verificando se não lança exceções
        $this->notification->EnviarNotificacaoBD(1, "João", "Teste mensagem");
    
        // Verifica que a operação foi bem-sucedida sem exceções
        $this->assertTrue(true);
    }

    public function testGetByClientId() {
        // Mock do método prepare
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockResult = $this->createMock(mysqli_result::class);
    
        // Configurando o mock para os métodos do statement
        $this->mockDataProvider->method('prepare')->willReturn($mockStmt);
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('get_result')->willReturn($mockResult);
    
        // Configurando o mock para fetch_all
        $mockResult->method('fetch_all')->with(MYSQLI_ASSOC)->willReturn([
            ['id' => 1, 'id_usuario' => 1, 'nome_cliente' => 'João', 'texto_mensagem' => 'Mensagem de teste'],
            ['id' => 2, 'id_usuario' => 1, 'nome_cliente' => 'João', 'texto_mensagem' => 'Outra mensagem'],
        ]);
    
        // Chamando o método e verificando o resultado
        $result = $this->notification->getByClientId(1);
    
        // Verifica que os dados retornados estão corretos
        $this->assertCount(2, $result);
        $this->assertEquals('João', $result[0]['nome_cliente']);
        $this->assertEquals('Mensagem de teste', $result[0]['texto_mensagem']);
}

}
