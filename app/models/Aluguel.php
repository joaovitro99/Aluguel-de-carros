<?php

class Aluguel {

   private $id_aluguel;
   private $id_cliente;
   private $id_veiculo;
   private $data_inicio;
   private $data_fim;
   private $valor_total;
   private $prazo_aluguel;

   public function __construct($id_aluguel = null, $id_cliente = null, $id_veiculo = null, $data_inicio = null, $data_fim = null, $valor_total = null) {
      $this->id_aluguel = $id_aluguel;
      $this->id_cliente = $id_cliente;
      $this->id_veiculo = $id_veiculo;
      $this->data_inicio = $data_inicio;
      $this->data_fim = $data_fim;
      $this->valor_total = $valor_total;
      $this->prazo_aluguel = $this->calcular_prazo();
   }

   // Getters e Setters

   public function getId() {
       return $this->id_aluguel;
   }

   public function setId($id_aluguel) {
       $this->id_aluguel = $id_aluguel;
   }

   public function getIdCliente() {
       return $this->id_cliente;
   }

   public function setIdCliente($id_cliente) {
       $this->id_cliente = $id_cliente;
   }

   public function getIdVeiculo() {
       return $this->id_veiculo;
   }

   public function setIdVeiculo($id_veiculo) {
       $this->id_veiculo = $id_veiculo;
   }

   public function getDataInicio() {
       return $this->data_inicio;
   }

   public function setDataInicio($data_inicio) {
       $this->data_inicio = $data_inicio;
       $this->prazo_aluguel = $this->calcular_prazo(); // Atualiza o prazo ao modificar a data
   }

   public function getDataFim() {
       return $this->data_fim;
   }

   public function setDataFim($data_fim) {
       $this->data_fim = $data_fim;
       $this->prazo_aluguel = $this->calcular_prazo(); // Atualiza o prazo ao modificar a data
   }

   public function getValorTotal() {
       return $this->valor_total;
   }

   public function setValorTotal($valor_total) {
       $this->valor_total = $valor_total;
   }

   public function getPrazoAluguel() {
       return $this->prazo_aluguel;
   }

   // Métodos adicionais

   /**
    * Calcula o prazo restante do aluguel em dias
    */
   public function calcular_prazo() {
      date_default_timezone_set('America/Sao_Paulo');
      $data_atual = new DateTime();
      $data_fim_formatada = new DateTime($this->data_fim);
      $diff = date_diff($data_atual, $data_fim_formatada);
      return (int) $diff->format('%a');
   }

   /**
    * Gera uma notificação para o cliente caso o prazo de aluguel esteja próximo do fim
    * @return string|false Mensagem de notificação ou false se não houver necessidade de notificação
    */
   public function notificar_cliente() {
      if ($this->prazo_aluguel > 0 && $this->prazo_aluguel < 5) {
         return "O aluguel encerrará em " . $this->prazo_aluguel . " dias";
      }
      return false;
   }
}
