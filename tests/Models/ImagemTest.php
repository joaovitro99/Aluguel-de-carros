<?php

use PHPUnit\Framework\TestCase;
//use App\Models\Image;
require_once __DIR__ . '/../../app/models/Imagem.php';

class ImagemTest extends TestCase {

    private $connMock;
    private $image;

    protected function setUp(): void {
        // Mock da conexão com o banco de dados (mysqli)
        $this->connMock = $this->createMock(mysqli::class);
        
        // Instanciando a classe Image com a conexão mockada
        $this->image = new Image($this->connMock);
    }

    public function testGetVehicleImagesReturnsImages() {
        // Simulando um retorno de imagens no banco de dados
        $id_veiculo = 1;
        
        // Dados simulados (imagens retornadas pelo banco)
        $mockedResult = $this->createMock(mysqli_result::class);
        $mockedResult->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['imagem' => 'image1.jpg'],
            ['imagem' => 'image2.jpg'],
            null // Retorna null no final para encerrar o loop
        );

        // Configurando o mock para o método prepare, sem mockar bind_param
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('bind_param')->willReturn(true);  // Apenas simula a execução de bind_param
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($mockedResult);
        
        // Configurando o mock para o método prepare, que retorna o stmtMock
        $this->connMock->method('prepare')->willReturn($stmtMock);

        // Chama o método getVehicleImages
        $images = $this->image->getVehicleImages($id_veiculo);

        // Testando se o retorno contém as imagens esperadas
        $this->assertIsArray($images);
        $this->assertCount(2, $images);
        $this->assertEquals('image1.jpg', $images[0]);
        $this->assertEquals('image2.jpg', $images[1]);
    }

    public function testGetVehicleImagesReturnsEmptyArrayIfNoImages() {
        // Simulando a ausência de imagens no banco de dados
        $id_veiculo = 1;

        // Dados simulados (sem imagens retornadas pelo banco)
        $mockedResult = $this->createMock(mysqli_result::class);
        $mockedResult->method('fetch_assoc')->willReturn(null); // Retorna null para indicar nenhuma imagem

        // Configurando o mock para o método prepare, sem mockar bind_param
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($mockedResult);

        // Configurando o mock para o método prepare, que retorna o stmtMock
        $this->connMock->method('prepare')->willReturn($stmtMock);

        // Chama o método getVehicleImages
        $images = $this->image->getVehicleImages($id_veiculo);

        // Testando se o retorno é um array vazio
        $this->assertIsArray($images);
        $this->assertCount(0, $images); // Nenhuma imagem encontrada
    }

    public function testGetVehicleImagesReturnsNullIfStatementFails() {
        // Simulando uma falha no prepare (retorna null quando o prepare falha)
        $id_veiculo = 1;

        // Configurando o mock para o método prepare retornar false (falha)
        $this->connMock->method('prepare')->willReturn(false);

        // Chama o método getVehicleImages
        $images = $this->image->getVehicleImages($id_veiculo);

        // Testando se o retorno é null devido à falha na preparação da consulta
        $this->assertNull($images);
    }
}
