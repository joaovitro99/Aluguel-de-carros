<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Aluguel.php';

class AluguelTest extends TestCase {

    private $aluguel;

    protected function setUp(): void {
        // Criando uma instância da classe Aluguel com dados de exemplo
        $this->aluguel = new Aluguel(
            1,          // id_aluguel
            101,        // id_cliente
            202,        // id_veiculo
            '2024-11-10',// data_inicio
            '2024-11-20',// data_fim
            500         // valor_total
        );
    }

    public function testGettersAndSetters() {
        // Testando os getters e setters
        $this->assertEquals(1, $this->aluguel->getId());
        $this->assertEquals(101, $this->aluguel->getIdCliente());
        $this->assertEquals(202, $this->aluguel->getIdVeiculo());
        $this->assertEquals('2024-11-10', $this->aluguel->getDataInicio());
        $this->assertEquals('2024-11-20', $this->aluguel->getDataFim());
        $this->assertEquals(500, $this->aluguel->getValorTotal());
    }

    public function testCalcularPrazoAluguel() {
        // Testando o método de cálculo do prazo de aluguel
        $prazo = $this->aluguel->calcular_prazo();
        
        // A data atual(17/11/2024) - DataFim , portanto, o prazo deve ser 2 dias
        $this->assertEquals(7, $prazo);
    }
    public function testNotificarCliente() {
        // Testando a notificação quando o prazo estiver próximo do fim
        $this->aluguel->setDataFim('2024-11-20'); // Data próxima do fim

        $notificacao = $this->aluguel->notificar_cliente();
        $this->assertEquals('O aluguel encerrará em 2 dias', $notificacao);

        // Testando quando não há necessidade de notificação
        $this->aluguel->setDataFim('2024-11-25'); // Data distante do fim
        $this->assertFalse($this->aluguel->notificar_cliente());
    }

    public function testAtualizarPrazoAoAlterarData() {
        // Testando se o prazo é recalculado ao alterar as datas
        $this->aluguel->setDataFim('2024-11-12'); // Alterando a data de fim
        $this->assertEquals(5, $this->aluguel->getPrazoAluguel()); // Prazo deve ser 2 dias

        $this->aluguel->setDataFim('2024-11-10'); // Alterando novamente a data de fim
        $this->assertEquals(7, $this->aluguel->getPrazoAluguel()); // Prazo deve ser 0 dias
    }
    
}