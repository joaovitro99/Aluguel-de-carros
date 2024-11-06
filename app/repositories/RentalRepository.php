<?php
require_once __DIR__.'/../models/Aluguel.php';
class RentalRepository {

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }


    public function insertAluguel($id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total){
        try {
            // Inserindo o cliente na tabela `clientes`
            $sql_aluguel = "INSERT INTO locacoes (id_cliente, id_veiculo, data_inicio, data_fim, valor_total) VALUES (?, ?, ?, ?, ?)";
            $sql_aluguel = $this->data_provider->prepare($sql_aluguel);
            $sql_aluguel->bind_param("iissd",$id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total);
            $sql_aluguel->execute();


        } catch (Exception $e) {
            // Rollback em caso de erro
            $this->data_provider->rollback();
            throw new Exception("Erro ao inserir o aluguel: " . $e->getMessage());
        }
    }

    


    public function getRendimentos($meses = null) {
        $whereClause = "";

        if ($meses !== 'tudo') {
            $whereClause = "WHERE l.data_inicio >= DATE_SUB(CURDATE(), INTERVAL ? MONTH)";
        }

        $query = "
            SELECT 
                v.marca, 
                v.modelo, 
                v.combustivel, 
                v.cambio, 
                v.valor_diaria, 
                COUNT(l.id_locacao) AS quantidade,
                SUM(v.valor_diaria * DATEDIFF(l.data_fim, l.data_inicio)) AS total_por_carro,
                img.imagem
            FROM 
                locacoes l
            JOIN 
                veiculos v ON l.id_veiculo = v.id_veiculo
            LEFT JOIN 
                imagens_veiculo img ON v.id_veiculo = img.id_veiculo
            $whereClause
            GROUP BY 
                v.id_veiculo;
        ";

        $stmt = $this->data_provider->prepare($query);

        if ($meses !== 'tudo') {
            $stmt->bind_param("i", $meses);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            return [];
        }

        $rentalData = [];
        while ($row = $result->fetch_assoc()) {
            $rentalData[] = $row;
        }

        return $rentalData;
    }

    /**
     * Obtém todos os aluguéis.
     * 
     * @return array Lista de objetos Aluguel.
     */
    public function getAll() {
        $sql = "SELECT * FROM locacoes";
        $result = $this->data_provider->query($sql);

        $alugueis = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $aluguel = new Aluguel(
                    $row['id_locacao'],
                    $row['id_cliente'],
                    $row['id_veiculo'],
                    $row['data_inicio'],
                    $row['data_fim'],
                    $row['valor_total']
                );
                $alugueis[] = $aluguel; // Adiciona o objeto Aluguel ao array
            }
        } else {
            // Tratar erros na consulta
            echo "Erro na consulta: " . $this->data_provider->error;
        }

        return $alugueis; // Retorna a lista de aluguéis
    }

    /**
     * Busca um aluguel pelo ID.
     * 
     * @param int $id ID do aluguel.
     * @return Aluguel|null Retorna o objeto Aluguel ou null se não encontrado.
     */
    public function findById($id) {
        $sql = "SELECT * FROM locacoes WHERE id_locacao = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            return new Aluguel(
                $row['id_locacao'],
                $row['id_cliente'],
                $row['id_veiculo'],
                $row['data_inicio'],
                $row['data_fim'],
                $row['valor_total']
            );
        }

        return null;
    }

    /**
     * Salva um aluguel no banco de dados (insere ou atualiza).
     * 
     * @param Aluguel $aluguel Objeto Aluguel a ser salvo.
     * @return bool Indica se a operação foi bem-sucedida.
     */
    public function save(Aluguel $aluguel) {
        if ($aluguel->getId()) {
            // Atualiza um aluguel existente
            $sql = "UPDATE locacoes SET id_cliente = ?, id_veiculo = ?, data_inicio = ?, data_fim = ?, valor_total = ? WHERE id_locacao = ?";
            $stmt = $this->data_provider->prepare($sql);
            $stmt->bind_param(
                "iisidi",
                $aluguel->getIdCliente(),
                $aluguel->getIdVeiculo(),
                $aluguel->getDataInicio(),
                $aluguel->getDataFim(),
                $aluguel->getValorTotal(),
                $aluguel->getId()
            );
        } else {
            // Insere um novo aluguel
            $sql = "INSERT INTO locacoes (id_cliente, id_veiculo, data_inicio, data_fim, valor_total) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->data_provider->prepare($sql);
            $stmt->bind_param(
                "iisid",
                $aluguel->getIdCliente(),
                $aluguel->getIdVeiculo(),
                $aluguel->getDataInicio(),
                $aluguel->getDataFim(),
                $aluguel->getValorTotal()
            );
        }

        return $stmt->execute();
    }

    /**
     * Exclui um aluguel pelo ID.
     * 
     * @param int $id ID do aluguel a ser excluído.
     * @return bool Indica se a operação foi bem-sucedida.
     */
    public function delete($id) {
        $sql = "DELETE FROM locacoes WHERE id_locacao = ?";
        $stmt = $this->data_provider->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
