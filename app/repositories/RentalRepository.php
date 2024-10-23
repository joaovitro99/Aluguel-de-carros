<?php

class RentalRepository {

    private $data_provider;

    public function __construct($dataProvider) {
        $this->data_provider = $dataProvider;
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
}
