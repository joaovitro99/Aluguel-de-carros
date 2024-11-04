<?php

class Aluguel {

   private $id_aluguel;
   private $id_cliente;
   private $id_veiculo;
   private $data_inicio;
   private $data_fim;
   private $valor_total;
   private $prazo_aluguel;

   public function __construct($id_aluguel, $id_cliente, $id_veiculo, $data_inicio, $data_fim, $valor_total) {
      $this->id_aluguel = $id_aluguel;
      $this->id_cliente = $id_cliente;
      $this->id_veiculo = $id_veiculo;
      $this->data_fim = $data_fim;
      $this->data_inicio = $data_inicio;
      $this->valor_total = $valor_total;
      $this->prazo_aluguel = $this->calcular_prazo();
   }

   public function getIdCliente()
   {
    return $this->id_cliente;
   }

   public function calcular_prazo() {
      
      date_default_timezone_set('America/Sao_Paulo');
      
     
      $data_atual = new DateTime();
      $data_fim_formatada = new DateTime($this->data_fim);
      
    
      $diff = date_diff($data_atual, $data_fim_formatada);
    
      return (int)$diff->format('%a');
   }

   public function notificar_cliente() {
      
      if ($this->prazo_aluguel > 0 && $this->prazo_aluguel < 5) {
         $str = "O aluguel encerrará em " . $this->prazo_aluguel . " dias";
         return $str;
      } else {
         return false;
      }
   }
}
