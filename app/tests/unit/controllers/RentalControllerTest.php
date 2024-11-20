<?php

use PHPUnit\Framework\TestCase;
use App\Repositories\RentalRepository;
use App\Repositories\ClientRepository;
use App\Controllers\RentalController;

class RentalControllerTest extends TestCase
{
    private $mockConn;
    private $mockRentalRepository;
    private $mockClientRepository;
    private $rentalController;

    protected function setUp(): void
    {
        // Criando o mock da conexão com o banco de dados
        $this->mockConn = $this->createMock(mysqli::class);

        // Mock para o RentalRepository, passando o mock da conexão
        $this->mockRentalRepository = $this->getMockBuilder(RentalRepository::class)
                                             ->setConstructorArgs([$this->mockConn])  // Passando $mockConn como dependência
                                             ->getMock();

        // Mock para o ClientRepository, passando o mock da conexão
        $this->mockClientRepository = $this->getMockBuilder(ClientRepository::class)
                                             ->setConstructorArgs([$this->mockConn])  // Passando $mockConn como dependência
                                             ->getMock();

        $this->rentalController = new RentalController($this->mockConn);
        

        // Mock para variáveis globais
        $_GET = [
            'id_cliente' => 1,
            'id_carro' => 10,
            'data_inicio' => '2024-01-01',
            'data_fim' => '2024-01-10'
        ];
        $_SESSION['carroReserva'] = [
            'marca' => 'Toyota',
            'modelo' => 'Corolla'
        ];
        $_SESSION['diasAlugados'] = 10;
    }

    public function testAddAluguelInsertsDataAndRedirects()
    {
        // Mock do método prepare() da conexão
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConn->method('prepare')->willReturn($mockStmt);

        // Mockando os métodos do stmt para simular a execução do SQL
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);

        // Simulando o insert no RentalRepository
        $this->mockRentalRepository->expects($this->once())
            ->method('insertAluguel')
            ->with(
                1, // id_cliente
                10, // id_carro
                '2024-01-01', // data_inicio
                '2024-01-10', // data_fim
                10 // valor_total
            )
            ->willReturn(true);

        // Capturar a saída para evitar erros de redirecionamento
        $this->expectOutputString('');

        // Executando o método
        $this->rentalController->addAluguel();

        // Verificando se o redirecionamento ocorreu corretamente
        $headers = headers_list();
        $this->assertContains(
            'Location: http://localhost/aluguel-de-carros/public/user/showProfile',
            $headers
        );
    }
}
