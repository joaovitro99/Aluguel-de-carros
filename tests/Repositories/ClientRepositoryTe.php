<?php

use PHPUnit\Framework\TestCase;
//use App\repositories\ClientRepository;
require_once __DIR__ . '/../../app/repositories/ClientRepository.php';

class ClientRepositoryTest extends TestCase
{
    private $clientRepository;
    private $dataProviderMock;

    protected function setUp(): void
    {
        // Criação do mock para o data_provider
        $this->dataProviderMock = $this->createMock(mysqli::class);

        // Instanciando o ClientRepository com o mock do data_provider
        $this->clientRepository = new ClientRepository($this->dataProviderMock);
    }

    public function testInsertClientSuccess()
    {
        // Dados simulados para a inserção
        $nome = "João Silva";
        $cpf = "12345678900";
        $email = "joao@exemplo.com";
        $endereco = "Rua Exemplo, 123";
        $telefone = "987654321";
        $nome_usuario = "joaosilva";
        $senha = "senha123";

        // Mock para os métodos de transação
        $this->dataProviderMock->expects($this->once())->method('begin_transaction');
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->exactly(2))->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute');
        $this->dataProviderMock->expects($this->once())->method('getInsertId')->willReturn(1);
        $this->dataProviderMock->expects($this->once())->method('commit');

        // Chama o método para inserir o cliente
        $id_cliente = $this->clientRepository->insertClient($nome, $cpf, $email, $endereco, $telefone, $nome_usuario, $senha);

        // Verifica se o ID do cliente inserido é 1
        $this->assertEquals(1, $id_cliente);
    }

    public function testInsertClientFailure()
    {
        // Dados simulados para a inserção
        $nome = "João Silva";
        $cpf = "12345678900";
        $email = "joao@exemplo.com";
        $endereco = "Rua Exemplo, 123";
        $telefone = "987654321";
        $nome_usuario = "joaosilva";
        $senha = "senha123";

        // Mock para os métodos de transação
        $this->dataProviderMock->expects($this->once())->method('begin_transaction');
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->exactly(2))->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute')->will($this->throwException(new Exception("Erro ao inserir o cliente")));
        $this->dataProviderMock->expects($this->once())->method('rollback');

        // Chama o método para inserir o cliente e verifica se a exceção é lançada
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Erro ao inserir o cliente: Erro ao inserir o cliente");
        $this->clientRepository->insertClient($nome, $cpf, $email, $endereco, $telefone, $nome_usuario, $senha);
    }

    public function testUpdateClientSuccess()
    {
        // Dados simulados para a atualização
        $id_cliente = 1;
        $nome = "João Silva";
        $cpf = "12345678900";
        $email = "joao@exemplo.com";
        $endereco = "Rua Exemplo, 123";
        $telefone = "987654321";

        // Mock para o método de preparação e execução
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->once())->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute')->willReturn(true);

        // Chama o método para atualizar o cliente
        $result = $this->clientRepository->updateClient($id_cliente, $nome, $cpf, $email, $endereco, $telefone);

        // Verifica se a atualização foi bem-sucedida
        $this->assertTrue($result);
    }

    public function testUpdateClientFailure()
    {
        // Dados simulados para a atualização
        $id_cliente = 1;
        $nome = "João Silva";
        $cpf = "12345678900";
        $email = "joao@exemplo.com";
        $endereco = "Rua Exemplo, 123";
        $telefone = "987654321";

        // Mock para o método de preparação e execução
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->once())->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute')->willReturn(false);

        // Chama o método para atualizar o cliente e verifica se a exceção é lançada
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Nenhuma alteração foi feita.");
        $this->clientRepository->updateClient($id_cliente, $nome, $cpf, $email, $endereco, $telefone);
    }

    public function testRemoveClientSuccess()
    {
        // Dados simulados para a remoção
        $id_cliente = 1;

        // Mock para o método de preparação e execução
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->once())->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute')->willReturn(true);

        // Chama o método para remover o cliente
        $result = $this->clientRepository->removeClient($id_cliente);

        // Verifica se a remoção foi bem-sucedida
        $this->assertTrue($result);
    }

    public function testRemoveClientFailure()
    {
        // Dados simulados para a remoção
        $id_cliente = 1;

        // Mock para o método de preparação e execução
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->once())->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute')->willReturn(false);

        // Chama o método para remover o cliente e verifica se a exceção é lançada
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Erro ao remover cliente.");
        $this->clientRepository->removeClient($id_cliente);
    }

    public function testGetClientSuccess()
    {
        $nome_usuario = "joaosilva";

        // Mock para o retorno do método
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->once())->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute');
        $this->dataProviderMock->expects($this->once())->method('get_result')->willReturn($this->createMock(mysqli_result::class));

        // Chama o método para buscar o cliente
        $result = $this->clientRepository->getClient($nome_usuario);

        // Verifica se o cliente foi encontrado
        $this->assertNotEmpty($result);
    }

    public function testGetClientFailure()
    {
        $nome_usuario = "joaosilva";

        // Mock para o retorno do método
        $this->dataProviderMock->expects($this->once())->method('prepare')->willReturnSelf();
        $this->dataProviderMock->expects($this->once())->method('bind_param');
        $this->dataProviderMock->expects($this->once())->method('execute');
        $this->dataProviderMock->expects($this->once())->method('get_result')->willReturn(null);

        // Chama o método para buscar o cliente e verifica se a exceção é lançada
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Cliente não encontrado.");
        $this->clientRepository->getClient($nome_usuario);
    }

    public function testGetAllClients()
    {
        // Mock para o retorno do método getAll
        $this->dataProviderMock->method('query')->willReturnSelf();
        $this->dataProviderMock->method('fetch_all')->willReturn([['id_cliente' => 1, 'nome' => 'João Silva']]);

        // Chama o método para buscar todos os clientes
        $result = $this->clientRepository->getAllClients();

        // Verifica se a listagem foi retornada corretamente
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }
}
