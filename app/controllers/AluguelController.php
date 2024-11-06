<?php

require_once("db.php");
require_once __DIR__ . "/../repositories/ClientRepository.php";
require_once __DIR__ . "/../repositories/RentalRepository.php";

class RentalController {
    private $rentalRepository;
    private $clientRepository;

    public function __construct() {
        global $db_conection;
        $this->rentalRepository = new RentalRepository($db_conection);
        $this->clientRepository = new ClientRepository($db_conection);
    }

    /**
     * Exibe a lista de todos os aluguéis
     */
    public function index() {
        // Busca todos os aluguéis
        $alugueis = $this->rentalRepository->getAll();

        // Retorna os aluguéis em formato JSON
        echo json_encode($alugueis);
    }

    /**
     * Exibe detalhes de um aluguel específico
     *
     * @param int $id ID do aluguel
     */
    public function show($id) {
        // Busca o aluguel pelo ID
        $aluguel = $this->rentalRepository->findById($id);

        if ($aluguel) {
            // Retorna os detalhes do aluguel em formato JSON
            echo json_encode($aluguel);
        } else {
            // Retorna um erro caso o aluguel não seja encontrado
            http_response_code(404);
            echo json_encode(['error' => 'Aluguel não encontrado']);
        }
    }

    /**
     * Cria um novo aluguel
     */
    public function create() {
        // Apenas aceite o método POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados da requisição (em formato JSON)
            $inputData = json_decode(file_get_contents("php://input"), true);

            if (!$inputData || !isset($inputData['id_cliente'], $inputData['id_veiculo'], $inputData['data_inicio'], $inputData['data_fim'], $inputData['valor_total'])) {
                // Se faltar dados obrigatórios, retorna erro 400
                http_response_code(400);
                echo json_encode(['error' => 'Dados inválidos ou incompletos']);
                return;
            }

            // Cria uma nova instância de aluguel e salva no banco de dados
            $aluguel = new Aluguel(
                null,
                $inputData['id_cliente'],
                $inputData['id_veiculo'],
                $inputData['data_inicio'],
                $inputData['data_fim'],
                $inputData['valor_total']
            );

            $this->rentalRepository->save($aluguel);

            // Retorna o aluguel criado com status 201
            http_response_code(201);
            echo json_encode($aluguel);
        } else {
            // Caso o método não seja POST, retorna erro 405 (Método não permitido)
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
    }

    /**
     * Atualiza um aluguel existente
     *
     * @param int $id ID do aluguel a ser atualizado
     */
    public function update($id) {
        // Busca o aluguel pelo ID
        $aluguel = $this->rentalRepository->findById($id);

        if (!$aluguel) {
            // Se o aluguel não for encontrado, retorna erro 404
            http_response_code(404);
            echo json_encode(['error' => 'Aluguel não encontrado']);
            return;
        }

        // Verifica se a requisição é um PUT (atualização)
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // Obtém os dados da requisição (em formato JSON)
            $inputData = json_decode(file_get_contents("php://input"), true);

            if (!$inputData || !isset($inputData['data_inicio'], $inputData['data_fim'], $inputData['valor_total'])) {
                // Se faltar dados obrigatórios, retorna erro 400
                http_response_code(400);
                echo json_encode(['error' => 'Dados inválidos ou incompletos']);
                return;
            }

            // Atualiza os dados do aluguel
            $aluguel->setDataInicio($inputData['data_inicio']);
            $aluguel->setDataFim($inputData['data_fim']);
            $aluguel->setValorTotal($inputData['valor_total']);

            // Salva as alterações no banco de dados
            $this->rentalRepository->save($aluguel);

            // Retorna o aluguel atualizado
            echo json_encode($aluguel);
        } else {
            // Caso o método não seja PUT, retorna erro 405 (Método não permitido)
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
    }

    /**
     * Exclui um aluguel
     *
     * @param int $id ID do aluguel a ser excluído
     */
    public function delete($id) {
        // Verifica se o aluguel existe
        $aluguel = $this->rentalRepository->findById($id);

        if (!$aluguel) {
            // Se o aluguel não for encontrado, retorna erro 404
            http_response_code(404);
            echo json_encode(['error' => 'Aluguel não encontrado']);
            return;
        }

        // Exclui o aluguel
        $this->rentalRepository->delete($id);

        // Retorna uma resposta de sucesso (sem conteúdo)
        http_response_code(204);
    }
}
