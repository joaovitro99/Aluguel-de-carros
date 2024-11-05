<?php

require_once 'models/Aluguel.php'; // Certifique-se de ajustar o caminho conforme sua estrutura de diretórios

class AluguelController {

    // Exibe a lista de todos os aluguéis
    public function index() {
        // Aqui você faria uma consulta ao banco de dados para obter todos os aluguéis
        $alugueis = Aluguel::getAll(); // Supondo que você tenha um método estático para buscar todos os aluguéis
        require 'views/aluguel/index.php'; // Carrega a view para exibir os aluguéis
    }

    // Exibe os detalhes de um aluguel específico
    public function show($id) {
        $aluguel = Aluguel::findById($id); // Supondo que você tenha um método estático para buscar por ID
        if ($aluguel) {
            require 'views/aluguel/show.php'; // Carrega a view com os detalhes do aluguel
        } else {
            echo "Aluguel não encontrado.";
        }
    }

    // Cria um novo aluguel
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Aqui você processaria os dados do formulário para criar um novo aluguel
            $id_cliente = $_POST['id_cliente'];
            $id_veiculo = $_POST['id_veiculo'];
            $data_inicio = $_POST['data_inicio'];
            $data_fim = $_POST['data_fim'];
            $valor_total = $_POST['valor_total'];

            // Cria uma instância de Aluguel e salva no banco de dados
            $aluguel = new Aluguel(null, $id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total);
            $aluguel->save();

            // Redireciona para a lista de aluguéis
            header('Location: /aluguel-de-carros/public/aluguel/index');
            exit();
        } else {
            require 'views/aluguel/create.php'; // Carrega a view de criação
        }
    }

    // Atualiza um aluguel existente
    public function update($id) {
        $aluguel = Aluguel::findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processa os dados do formulário para atualizar o aluguel
            $aluguel->setDataInicio($_POST['data_inicio']);
            $aluguel->setDataFim($_POST['data_fim']);
            $aluguel->setValorTotal($_POST['valor_total']);
            $aluguel->save();

            // Redireciona para a lista de aluguéis
            header('Location: /aluguel-de-carros/public/aluguel/index');
            exit();
        } else {
            require 'views/aluguel/edit.php'; // Carrega a view de edição com os dados do aluguel
        }
    }

    // Exclui um aluguel
    public function delete($id) {
        $aluguel = Aluguel::findById($id);
        if ($aluguel) {
            $aluguel->delete();
        }
        // Redireciona para a lista de aluguéis
        header('Location: /aluguel-de-carros/public/aluguel/index');
        exit();
    }

    // Notifica clientes sobre prazos de aluguel próximos de expirar
    public function notificarClientes() {
        $alugueis = Aluguel::getAll();
        foreach ($alugueis as $aluguel) {
            $mensagem = $aluguel->notificar_cliente();
            if ($mensagem) {
                // Aqui você enviaria a notificação ao cliente (ex: via email ou SMS)
                echo "Notificação enviada para cliente com ID {$aluguel->getIdCliente()}: {$mensagem}<br>";
            }
        }
    }
}
