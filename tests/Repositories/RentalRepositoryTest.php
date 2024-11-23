<?php

use PHPUnit\Framework\TestCase;
//use App\Repositories\RentalRepository;
require_once __DIR__ . '/../../app/repositories/RentalRepository.php';

class RentalRepositoryTest extends TestCase
{
    private $mockDataProvider;
    private $repository;

    protected function setUp(): void
    {
        // Criação do mock para o data_provider
        $this->mockDataProvider = $this->createMock(mysqli::class);

        // Instancia o RentalRepository com o mock
        $this->repository = new RentalRepository($this->mockDataProvider);
    }

    public function testInsertAluguel()
    {
        // Mock do método prepare
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with('iissd', 1, 2, '2024-11-22', '2024-11-25', 500.00)
            ->willReturn(true);

        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockDataProvider->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO locacoes (id_cliente, id_veiculo, data_inicio, data_fim, valor_total) VALUES (?, ?, ?, ?, ?)")
            ->willReturn($mockStmt);

        $this->repository->insertAluguel(1, 2, '2024-11-22', '2024-11-25', 500.00);
    }

    public function testGetRendimentosReturnsData()
    {
        // Mock do mysqli_result
        $mockResult = $this->createMock(mysqli_result::class);

        // Configura o mock para `fetch_assoc`
        $mockResult->expects($this->exactly(2)) // Chama duas vezes: uma para o dado e outra para null
            ->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                [
                    'marca' => 'Toyota',
                    'modelo' => 'Corolla',
                    'combustivel' => 'Gasolina',
                    'cambio' => 'Manual',
                    'valor_diaria' => 150.00,
                    'quantidade' => 3,
                    'total_por_carro' => 450.00,
                    'imagem' => 'imagem.jpg',
                ],
                null
            );

        // Mock do mysqli_stmt
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $mockStmt->expects($this->once())
            ->method('get_result')
            ->willReturn($mockResult);

        // Mock do data_provider para o prepare
        $this->mockDataProvider->expects($this->once())
            ->method('prepare')
            ->willReturn($mockStmt);

        // Chama o método a ser testado
        $data = $this->repository->getRendimentos('tudo');

        // Verifica os resultados
        $this->assertCount(1, $data); // Apenas 1 registro esperado
        $this->assertEquals('Toyota', $data[0]['marca']);
        $this->assertEquals('Corolla', $data[0]['modelo']);
    }
}
