
<?php
use PHPUnit\Framework\TestCase;

class carTest extends TestCase
{
    private $mockDataProvider;
    private $carRepository;

    protected function setUp(): void
    {
        // Criando um mock do data provider
        $this->mockDataProvider = $this->createMock(mysqli::class);
        
        // Inicializando o repositório com o mock
        $this->carRepository = new CarRepository($this->mockDataProvider);
    }

    public function testInsertCar()
    {
        // Mockando o prepare e bind_param
        $mockStmt = $this->createMock(mysqli_stmt::class);

        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with(
                $this->equalTo("ssisdiidss"),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything()
            );

        $mockStmt->expects($this->once())->method('execute');

        $this->mockDataProvider->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('INSERT INTO veiculos'))
            ->willReturn($mockStmt);

        // Chamando o método
        $this->carRepository->insertCar(
            'Toyota', 'Corolla', 2023, 'XYZ-1234', 200.50, 1, 5, 2.5, 'Automático', 'Gasolina'
        );
    }

    public function testRemoveCar()
    {
        $mockStmt = $this->createMock(mysqli_stmt::class);

        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->anything());

        $mockStmt->expects($this->once())->method('execute');
        $mockStmt->expects($this->once())->method('close');

        $this->mockDataProvider->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('DELETE FROM veiculos'))
            ->willReturn($mockStmt);

        $this->carRepository->removeCar(1);
    }

    public function testGetCar()
    {
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockResult = $this->createMock(mysqli_result::class);

        $mockResult->expects($this->once())
            ->method('num_rows')
            ->willReturn(1);

        $mockResult->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn(['id_veiculo' => 1, 'marca' => 'Toyota']);

        $mockStmt->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("i"), $this->anything());

        $mockStmt->expects($this->once())
            ->method('execute');

        $mockStmt->expects($this->once())
            ->method('get_result')
            ->willReturn($mockResult);

        $this->mockDataProvider->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains('SELECT * FROM veiculos WHERE id_veiculo'))
            ->willReturn($mockStmt);

        $car = $this->carRepository->getCar(1);

        $this->assertIsArray($car);
        $this->assertEquals('Toyota', $car['marca']);
    }
}
