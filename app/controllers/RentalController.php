<?php
require_once("db.php");
require_once __DIR__."/../repositories/ClientRepository.php";
require_once __DIR__."/../repositories/RentalRepository.php";
class RentalController{
    private $rentalRepository;
    private $clientRepository;

    public function __construct() {
        global $db_conection;
        $this->rentalRepository = new RentalRepository($db_conection);
        $this->clientRepository = new ClientRepository($db_conection);
    }
    

    public function enviarNotificacao($cliente_info,$msn,$tipo){

        // URL da API
        $url = 'http://localhost/aluguel-de-carros/public/notification/send';

        $email= $cliente_info['email'];
        $nome= $cliente_info['nome'];
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