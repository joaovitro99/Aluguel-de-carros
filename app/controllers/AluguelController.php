<?php

use App\Repositories\RentalRepository;
use App\Models\Aluguel;
use App\Repositories\ClientRepository;

require_once("db.php");
require_once __DIR__ . "/../repositories/ClientRepository.php";
require_once __DIR__ . "/../repositories/RentalRepository.php";

class AluguelController {
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
        
        // Inclui a view para exibir os aluguéis
        include __DIR__ . '/../views/alugueis.php';
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
            // Inclui a view para exibir os detalhes do aluguel
            include __DIR__ . '/../views/aluguel_detalhes.php';
        } else {
            echo "Aluguel não encontrado.";
        }
    }

    /**
     * Cria um novo aluguel
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário para criar um novo aluguel
            $id_cliente = $_POST['id_cliente'];
            $id_veiculo = $_POST['id_veiculo'];
            $data_inicio = $_POST['data_inicio'];
            $data_fim = $_POST['data_fim'];
            $valor_total = $_POST['valor_total'];

            // Cria uma nova instância de aluguel e salva no banco de dados
            $aluguel = new Aluguel(null, $id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total);
            $this->rentalRepository->save($aluguel);

            // Redireciona para a lista de aluguéis
            header('Location: /aluguel-de-carros/public/aluguel/index');
            exit();
        } else {
            // Exibe o formulário de criação
            include __DIR__ . '/../views/aluguel_form.php';
        }
    }

    /**
     * Atualiza um aluguel existente
     *
     * @param int $id ID do aluguel a ser atualizado
     */
    public function update($id) {
        $aluguel = $this->rentalRepository->findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário para atualizar o aluguel
            $aluguel->setDataInicio($_POST['data_inicio']);
            $aluguel->setDataFim($_POST['data_fim']);
            $aluguel->setValorTotal($_POST['valor_total']);

            // Salva as alterações no banco de dados
            $this->rentalRepository->save($aluguel);

            // Redireciona para a lista de aluguéis
            header('Location: /aluguel-de-carros/public/aluguel/index');
            exit();
        } else {
            // Exibe o formulário de edição com os dados do aluguel
            include __DIR__ . '/../views/aluguel_form.php';
        }
    }

    /**
     * Exclui um aluguel
     *
     * @param int $id ID do aluguel a ser excluído
     */
    public function delete($id) {
        $this->rentalRepository->delete($id);

        // Redireciona para a lista de aluguéis
        header('Location: /aluguel-de-carros/public/aluguel/index');
        exit();                                                                                                 
    }
}
