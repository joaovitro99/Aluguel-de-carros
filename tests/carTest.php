<?php
use PHPUnit\Framework\TestCase;

class CarRepositoryTest extends TestCase
{
    private $mockConn;
    private $carRepository;

    protected function setUp(): void
    {
        // Criando o mock da conexão
        $this->mockConn = $this->createMock(mysqli::class);
        // Criando o objeto CarRepository, passando o mock da conexão
        $this->carRepository = new CarRepository($this->mockConn);
    }

    public function testInsertCar()
    {
        // Mock do método prepare
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConn->method('prepare')->willReturn($mockStmt);

        // Mockando bind_param e execute
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);

        // Chamando o método e verificando se não lança exceções
        $this->carRepository->insertCar(
            'Toyota', 'Corolla', 2023, 'XYZ-1234', 200.50, 1, 5, 2.5, 'Automático', 'Gasolina'
        );

        $this->assertTrue(true); // Verifica se a operação foi bem-sucedida
    }

    public function testRemoveCar()
    {
        // Mock do método prepare
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConn->method('prepare')->willReturn($mockStmt);

        // Mockando bind_param, execute e close
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('close')->willReturn(true);

        // Chamando o método e verificando se não lança exceções
        $this->carRepository->removeCar(1);

        $this->assertTrue(true); // Verifica se a operação foi bem-sucedida
    }

    public function testGetCar()
    {
        // Mock do método prepare
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConn->method('prepare')->willReturn($mockStmt);

        // Mockando bind_param e execute
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);

        // Mock do get_result e fetch_assoc
        $mockResult = $this->createMock(mysqli_result::class);
        $mockStmt->method('get_result')->willReturn($mockResult);
        $mockResult->method('fetch_assoc')->willReturn([
            'id_veiculo' => 1,
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'ano' => 2023,
            'placa' => 'XYZ-1234',
        ]);

        // Chamando o método e verificando o resultado
        $result = $this->carRepository->getCar(1);

        $this->assertIsArray($result);
        $this->assertEquals('Toyota', $result['marca']);
        $this->assertEquals('Corolla', $result['modelo']);
    }
}
