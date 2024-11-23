<?php

use PHPUnit\Framework\TestCase;
use App\Repositories\CarRepository;
use App\Controllers\HomeController;
require_once 'C:\wamp64\www\Aluguel-de-carros\config\config.php';

class HomeControllerTest extends TestCase
{
    private $homeController;
    private $carRepositoryMock;

    protected function setUp(): void
    {
        // Criação de um mock para a classe CarRepository
        $this->carRepositoryMock = $this->createMock(CarRepository::class);
        
        // Injeção do mock no controlador
        $this->homeController = new HomeController();
        
        // Substituir a propriedade car_repository pelo mock
        $reflection = new ReflectionClass($this->homeController);
        $property = $reflection->getProperty('car_repository');
        $property->setAccessible(true);
        $property->setValue($this->homeController, $this->carRepositoryMock);
    }

    public function testIndex()
    {
        // Definindo o comportamento do mock: Retornar um carro válido para os primeiros 5 IDs
        $this->carRepositoryMock
            ->method('getCar')
            ->willReturnCallback(function($id) {
                if ($id <= 5) {
                    return [
                        'id_veiculo' => $id,
                        'marca' => 'Marca ' . $id,
                        'modelo' => 'Modelo ' . $id,
                        'capacidade_pessoas' => 4,
                        'ano' => 2020,
                        'cambio' => 'Automático'
                    ];
                }
                return null;
            });

        // Chamada ao método index
        $this->homeController->index();
        
        // Assertiva para garantir que 5 carros foram adicionados ao array $carros
        // Esse teste depende de verificar o conteúdo gerado na view (presumivelmente),
        // então precisamos garantir que o comportamento interno seja esperado.
        // Isso pode ser feito com inspeção dos dados ou testando a geração da view
        // (por exemplo, usando saída capturada).

        // Aqui poderia ser feito outro tipo de verificação para garantir que o método index 
        // funcione corretamente, como capturar a saída renderizada.
        $this->expectOutputString("Marca 1Modelo 1"); // Exemplo simples de verificação
    }
}
