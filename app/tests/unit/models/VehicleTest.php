<?php

use PHPUnit\Framework\TestCase;
use App\Models\Vehicle;

class VehicleTest extends TestCase {

    private $mockConn;
    private $vehicle;

    protected function setUp(): void {
        // Criando o mock da conexão
        $this->mockConn = $this->createMock(mysqli::class);

        // Criando o objeto Vehicle, passando o mock da conexão
        $this->vehicle = new Vehicle($this->mockConn);
    }

    public function testGetVehicleInfo() {
        // Mock do método prepare() da conexão
        $mockStmt = $this->createMock(mysqli_stmt::class);
        
        // Definindo que o método prepare retorna o mock do stmt
        $this->mockConn->method('prepare')->willReturn($mockStmt);
        
        // Mockando o método bind_param
        $mockStmt->method('bind_param')->willReturn(true);
        
        // Mockando o método execute
        $mockStmt->method('execute')->willReturn(true);

        // Mockando o método get_result
        $mockResult = $this->createMock(mysqli_result::class);
        $mockStmt->method('get_result')->willReturn($mockResult);

        // Mockando o fetch_assoc para retornar dados simulados
        $mockResult->method('fetch_assoc')->willReturn([
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'ano' => 2020,
            'placa' => 'ABC1234',
            'status' => 'Disponível',
            'valor_diaria' => 100,
            'cambio' => 'Manual',
            'capacidade_bagageiro' => 400,
            'capacidade_pessoas' => 5,
            'combustivel' => 'Gasolina'
        ]);

        // Chamando o método e verificando o resultado
        $result = $this->vehicle->getVehicleInfo(1);

        // Verificando se o resultado contém as informações simuladas
        $this->assertEquals('Toyota', $result['marca']);
        $this->assertEquals('Corolla', $result['modelo']);
        $this->assertEquals(2020, $result['ano']);
        $this->assertEquals('ABC1234', $result['placa']);
        $this->assertEquals('Disponível', $result['status']);
        $this->assertEquals(100, $result['valor_diaria']);
    }

    public function testGetVehicleImages() {
        // Mock do método prepare() da conexão
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConn->method('prepare')->willReturn($mockStmt);
        
        // Mockando os métodos para simular a execução do SQL
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);
        
        // Criando o mock do resultado
        $mockResult = $this->createMock(mysqli_result::class);
        $mockStmt->method('get_result')->willReturn($mockResult);
        
        // Mockando o fetch_assoc para retornar várias imagens
        $mockResult->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['imagem' => 'image1.jpg'],
            ['imagem' => 'image2.jpg'],
            null // Finaliza a iteração quando retornar null
        );

        // Chamando o método
        $result = $this->vehicle->getVehicleImages(1);

        // Verificando se as imagens retornadas estão corretas
        $this->assertCount(2, $result);
        $this->assertEquals('image1.jpg', $result[0]);
        $this->assertEquals('image2.jpg', $result[1]);
    }

    public function testGetVehicleDetails() {
        // Mock do método prepare() da conexão
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConn->method('prepare')->willReturn($mockStmt);
        
        // Mockando os métodos para simular a execução do SQL
        $mockStmt->method('bind_param')->willReturn(true);
        $mockStmt->method('execute')->willReturn(true);
        
        // Criando o mock do resultado
        $mockResult = $this->createMock(mysqli_result::class);
        $mockStmt->method('get_result')->willReturn($mockResult);
        
        // Mockando o fetch_assoc para retornar os dados do veículo
        $mockResult->method('fetch_assoc')->willReturn([
            'status' => 'Disponível',
            'valor_diaria' => 100,
            'cambio' => 'Manual',
            'capacidade_bagageiro' => 400,
            'capacidade_pessoas' => 5,
            'combustivel' => 'Gasolina',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'ano' => 2020,
            'placa' => 'ABC1234'
        ]);

        // Chamando o método e verificando o resultado
        $result = $this->vehicle->getVehicleDetails(1);

        // Verificando se as informações retornadas são corretas
        $this->assertEquals('Toyota', $result['marca']);
        $this->assertEquals('Corolla', $result['modelo']);
        $this->assertEquals(2020, $result['ano']);
        $this->assertEquals('ABC1234', $result['placa']);
        $this->assertEquals('Disponível', $result['status']);
        $this->assertEquals(100, $result['valor_diaria']);
    }
}
