<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

require_once __DIR__ . '/../../app/controllers/IncomeController.php';
require_once __DIR__ . '/../../app/repositories/RentalRepository.php';

class IncomeControllerTest extends TestCase {
    /**
     * @var RentalRepository|MockObject
     */
    private $mockRentalRepository;

    /**
     * @var IncomeController
     */
    private $incomeController;

    protected function setUp(): void {
        // Mock do repositório
        $this->mockRentalRepository = $this->createMock(RentalRepository::class);

        // Instancia o controlador
        $this->incomeController = new IncomeController();

        // Atribui o mock ao controlador usando Reflection
        $reflection = new ReflectionClass(IncomeController::class);
        $property = $reflection->getProperty('rentalRepository');
        $property->setAccessible(true);
        $property->setValue($this->incomeController, $this->mockRentalRepository);
    }

    public function testIndexReturnsRendimentosForIntervalo() {
        $_GET['intervalo'] = '3';

        $mockData = [
            [
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'combustivel' => 'Gasolina',
                'cambio' => 'Automático',
                'valor_diaria' => 150,
                'quantidade' => 10,
                'total_por_carro' => 4500,
                'imagem' => 'corolla.jpg',
            ],
            [
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'combustivel' => 'Flex',
                'cambio' => 'Manual',
                'valor_diaria' => 180,
                'quantidade' => 5,
                'total_por_carro' => 2700,
                'imagem' => 'civic.jpg',
            ],
        ];

        $this->mockRentalRepository
            ->expects($this->once())
            ->method('getRendimentos')
            ->with('3') // Verifica que o intervalo é passado corretamente
            ->willReturn($mockData);

        ob_start();
        $this->incomeController->index();
        $output = ob_get_clean();

        // Verifica se os dados estão presentes na saída (simula a view `rendimento.php`)
        $this->assertStringContainsString('Toyota', $output);
        $this->assertStringContainsString('Corolla', $output);
        $this->assertStringContainsString('R$4.500,00', $output);

        $this->assertStringContainsString('Honda', $output);
        $this->assertStringContainsString('Civic', $output);
        $this->assertStringContainsString('R$2.700,00', $output);
    }

    public function testIndexHandlesNoData() {
        $_GET['intervalo'] = '6';

        $this->mockRentalRepository
            ->expects($this->once())
            ->method('getRendimentos')
            ->with('6') // Verifica que o intervalo é passado corretamente
            ->willReturn([]); // Nenhum dado retornado

        ob_start();
        $this->incomeController->index();
        $output = ob_get_clean();

        // Verifica se a saída gerada reflete a ausência de dados
        $this->assertStringNotContainsString('Toyota', $output);
        $this->assertStringNotContainsString('Corolla', $output);
        $this->assertStringNotContainsString('4500', $output);
    }

}
