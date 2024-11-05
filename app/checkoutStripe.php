<?php
require '../vendor/autoload.php';
session_start();

\Stripe\Stripe::setApiKey('sk_test_51Q84E5Fa9ArriDU8CBV254ITGpzJlTSA5fJUrGXg07end7vFy9ybsGaU9OKWrtRMHExhLno80N4fImUkqAHRVUjq00NsnYUvds');
$carro = $_SESSION['reservaCarro'];
$valor = ((int)$carro['valor_diaria']) * ((int)$_SESSION['diasAlugados']) * 1.12;

// Dados da sessão de checkout
$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card', 'boleto'], // Tipos de pagamento aceitos
  'line_items' => [[
    'price_data' => [
      'currency' => 'brl', // Moeda
      'product_data' => [
        'name' => $carro['marca'].' '.$carro['modelo'], // Nome do produto
        'description' => 'Aluguel de carro por ' . $_SESSION['diasAlugados'] . ' dias', // Descrição do pagamento
      ],
      'unit_amount' => $valor * 100, // Valor em centavos
    ],
    'quantity' => 1, // Quantidade
  ]],
  'mode' => 'payment', // Modo de pagamento
  'success_url' => "http://localhost/aluguel-de-carros/public/rental/add?id_cliente='1'&id_carro='1'&data_inicio='10-11-14'&data_fim='10-11-14'&valor_diaria='1000'", // URL de sucesso
  'cancel_url' => 'https://seusite.com/cancelado', // URL de cancelamento
]);

echo json_encode(['id' => $session->id]);
