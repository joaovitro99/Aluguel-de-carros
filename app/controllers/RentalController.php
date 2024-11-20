<?php
namespace App\Controllers;
use Stripe\Terminal\Location;
use App\Repositories\RentalRepository;
use App\Repositories\ClientRepository;
//use App\Repositories\Notification;

require_once("db.php");
require_once __DIR__."/../repositories/ClientRepository.php";
require_once __DIR__."/../repositories/RentalRepository.php";
//require_once __DIR__."/../repositories/NotificacaoRepository.php";
class RentalController{
    private $rentalRepository;
    private $clientRepository;
    private $notificacaoRepository;

    public function __construct() {
        global $db_conection;
        $this->rentalRepository = new RentalRepository($db_conection);
        $this->clientRepository = new ClientRepository($db_conection);
        //$this->notificacaoRepository = new Notification($db_conection);
    }
    public function addAluguel()
    {

        $id_cliente=$_GET['id_cliente'];
        $id_veiculo=$_GET['id_carro'];
        $data_inicio=$_GET['data_inicio'];
        $data_fim=$_GET['data_fim'];
        $valor_total=10;
        
        $this->rentalRepository->insertAluguel($id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total);
        $carro=$_SESSION['carroReserva'];

        $cliente = $this->clientRepository->getClient($id_cliente);
        $cliente_info= [
            'email'=>$cliente['email'],
            'nome'=>$cliente['nome']
        ];

        $mensagem= "Caro (a) cliente \n sua reserva do veículo ".$carro['marca']." ".$carro['modelo']." para ".$_SESSION['diasAlugados']." dias foi confirmada com sucesso. Agradecemos sua preferência.";
       // $this->enviarNotificacao($cliente_info,$mensagem,'email');
       header("Location: http://localhost/aluguel-de-carros/public/user/showProfile");

    }
    

    public function enviarNotificacao($cliente_info,$msn,$tipo){

        // URL da API
        $url = 'http://localhost/aluguel-de-carros/public/notification/send';

        $email= $cliente_info['email'];
        $nome= $cliente_info['nome'];
        if (isset($cliente_info['id_cliente'])) {
            $id_cliente= $cliente_info['id_cliente'];
        }

        $mensagem= "Caro cliente ".$nome.", ".$msn;

       
        $data = http_build_query([
            'recipient' => $email,
            'message' => $mensagem,
            'type' => $tipo
        ]);

        // Configura o contexto da requisição
        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                            "Content-Length: " . strlen($data) . "\r\n",
                'method' => 'POST',
                'content' => $data,
            ]
        ];

        $context = stream_context_create($options);

        // Executa a requisição
        $response = file_get_contents($url, false, $context);

        // Verifica se houve erro
        if ($response === FALSE) {
            return 'Erro ao fazer a requisição.';
        } else {
            if (isset($cliente_info['id_cliente'])) {
                $this->notificacaoRepository->EnviarNotificacaoBD($id_cliente,$nome,$mensagem);
            }
    
            return $response;
            
        }
       


    }

    public function showAlugueis() {
        if (!isset($_SESSION['id_cliente'])) {
            echo "Erro: Usuário não está logado.";
            exit();
        }

        // Obtém os dados do cliente
        
        // Obtém os veículos do cliente
        $rentalHistory = $this->rentalRepository->findByIdcliente($_SESSION['id_cliente']);

        // Carrega a view
        require '../app/views/perfil.php';
    }


    public function verificarNotificacao(){
    
        $alugueis= $this->rentalRepository->getAll();

        foreach( $alugueis as $aluguel )
        {
            $mensagem=$aluguel->notificar_cliente();
            
            if($mensagem){
                $cliente = $this->clientRepository->getClient($aluguel->getIdCliente());
                var_dump($aluguel);
                $cliente_info= [
                    'id_cliente'=>$cliente['id_cliente'],
                    'email'=>$cliente['email'],
                    'nome'=>$cliente['nome']
                ];
                
                $response=$this->enviarNotificacao($cliente_info,$mensagem,'email');

                if ($response !== 'Erro ao fazer a requisição.') {
                    echo "Notificação enviada para: " . $cliente_info['email'] . "\n";
                } else {
                    echo "Falha ao enviar notificação para: " . $cliente_info['email'] . "\n";
                }
        
                

            }
        }

        

    }
    
    public function enviarManualmente() {
        $statusMessage = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $nome = $_POST['nome'];
            $mensagem = $_POST['mensagem'];
    
            // Envia a notificação
            $cliente_info = [
                'email' => $email,
                'nome' => $nome
            ];
            
            $response = $this->enviarNotificacao($cliente_info, $mensagem, 'email');
    
            // Exibir a resposta
            if ($response !== 'Erro ao fazer a requisição.') {
                $_SESSION['statusMessage'] = "Notificação enviada com sucesso para: " . $cliente_info['email'];
                $_SESSION['statusClass'] = 'success';
            } else {
                $_SESSION['statusMessage'] = "Falha ao enviar notificação para: " . $cliente_info['email'];
                $_SESSION['statusClass'] = 'error';
            }
    
            // Redireciona para evitar reenvio do formulário
            header("Location: http://localhost/aluguel-de-carros/public/notificacao/enviarManual");
            exit;
        } 
        include __DIR__ . '/../../notificationsAPI/public/send_notificacao.php';

            // Exibe o formulário HTML para envio manual
    }
    
    public function enviarEmailRecuperacao($email, $linkParaRedefinirSenha) {
        // Preparar mensagem de recuperação
        $mensagem = "Para redefinir sua senha, clique no link abaixo:\n\n"
        . "$linkParaRedefinirSenha\n\n"
        . "Se você não solicitou redefinir o seu email, ignore esta mensagem.\n\n";

        // Você pode personalizar o tipo para "email" ou outro que achar necessário
        $cliente_info = [
            'email' => $email,
            'nome' => ' ' // Nome do cliente pode ser recuperado ou preenchido conforme necessário
        ];
        
        // Enviar email de recuperação
        return $this->enviarNotificacao($cliente_info, $mensagem, 'email');

        // Exibir a resposta
        if ($response !== 'Erro ao fazer a requisição.') {
            $_SESSION['statusMessage'] = "Notificação enviada com sucesso para: " . $cliente_info['email'];
            $_SESSION['statusClass'] = 'success';
        } else {
            $_SESSION['statusMessage'] = "Falha ao enviar notificação para: " . $cliente_info['email'];
            $_SESSION['statusClass'] = 'error';
        }

        // Redireciona para evitar reenvio do formulário
        header("Location: http://localhost/aluguel-de-carros/public/user/forgotPassword");
        exit;
    }

}