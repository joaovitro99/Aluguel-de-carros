<?php
require_once("db.php");
require_once __DIR__."/../repositories/ClientRepository.php";
require_once __DIR__."/../repositories/RentalRepository.php";
require_once __DIR__."/../repositories/NotificacaoRepository.php";
class RentalController{
    private $rentalRepository;
    private $clientRepository;
    private $notificacaoRepository;

    public function __construct() {
        global $db_conection;
        $this->rentalRepository = new RentalRepository($db_conection);
        $this->clientRepository = new ClientRepository($db_conection);
        $this->notificacaoRepository = new Notification($db_conection);
    }
    

    public function enviarNotificacao($cliente_info,$msn,$tipo){

        // URL da API
        $url = 'http://localhost/aluguel-de-carros/public/notification/send';

        $email= $cliente_info['email'];
        $nome= $cliente_info['nome'];
        $id_cliente= $cliente_info['id_cliente'];
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
            $this->notificacaoRepository->EnviarNotificacaoBD($id_cliente,$nome,$mensagem);
            return $response;
        }
       


    }


    public function verificarNotificacao(){
    
        $alugueis= $this->rentalRepository->getAll();

        foreach( $alugueis as $aluguel )
        {
            $mensagem=$aluguel->notificar_cliente();
            
            if($mensagem){
                $cliente = $this->clientRepository->getClient($aluguel->getIdCliente());
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



}