<?php
class RentalRepository {

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
    }

    public function insertAluguel($id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total){
        try {
            // Inserindo o cliente na tabela `clientes`
            $sql_aluguel = "INSERT INTO locacoes (id_aluguel, id_cliente, id_veiculo, data_inicio, data_fim, valor_total) VALUES (?, ?, ?, ?, ?)";
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




}
