<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

require_once __DIR__ . '/../../app/controllers/CarController.php';
require_once __DIR__ . '/../../app/repositories/CarRepository.php';

class CarControllerTest extends TestCase {
    /**
     * @var CarRepository|MockObject
     */
    private $mockCarRepository;

    /**
     * @var CarController
     */
    private $carController;

    protected function setUp(): void {
        $this->mockCarRepository = $this->createMock(CarRepository::class);
        $this->carController = new CarController();
        $reflection = new ReflectionClass(CarController::class);
        $property = $reflection->getProperty('carRepository');
        $property->setAccessible(true);
        $property->setValue($this->carController, $this->mockCarRepository);
    }
    
    public function testDeleteCarroWithValidId() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['id_veiculo'] = '1';
    
        $this->mockCarRepository
            ->expects($this->once())
            ->method('removeCar')
            ->with('1');
    
        ob_start();
        $this->carController->deleteCarro();
        $output = ob_get_clean();
    
        $this->assertJsonStringEqualsJsonString(
            json_encode(['status' => 'success', 'message' => 'Carro removido com sucesso']),
            $output
        );
    }

    public function testBuscarAdminFilterReturnsValidData() {
        $_GET['term'] = 'Civic';
    
        // Mock do resultado para retornar uma linha e depois null
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->expects($this->exactly(2))  // Espera que o método seja chamado duas vezes
            ->method('fetch_assoc')
            ->willReturnOnConsecutiveCalls(
                ['id_veiculo' => 1, 'modelo' => 'Civic'],  // Primeira chamada retorna um veículo
                null  // Segunda chamada retorna null (fim dos resultados)
            );
    
        $this->mockCarRepository
            ->expects($this->once())
            ->method('getCarByterm')
            ->with('Civic')
            ->willReturn($mockResult);
    
        ob_start();
        $this->carController->buscarAdminFilter();
        $output = ob_get_clean();
    
        // Verifica se o JSON gerado está correto
        $this->assertJsonStringEqualsJsonString(
            json_encode([['id_veiculo' => 1, 'modelo' => 'Civic']]),  // Espera que a resposta contenha o veículo
            $output
        );
    }
    
}
