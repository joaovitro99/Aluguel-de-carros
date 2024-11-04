<?php


class MySqlDataProvider {

    private $db_conection;

    function __construct($config)
    {
        try {
            $this->db_conection = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
            
            if ($this->db_conection->connect_error) {
                throw new Exception("Falha na conexão: " . $this->db_conection->connect_error);
            }
        } catch (Exception $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function begin_transaction() {
        return $this->db_conection->begin_transaction();
    }

    public function commit() {
        return $this->db_conection->commit();
    }

    public function rollback() {
        return $this->db_conection->rollback();
    }

    public function prepare($query) {
        return $this->db_conection->prepare($query);
    }

    public function query($sql) {
        return $this->db_conection->query($sql);
    }

    public function getInsertId() {
        return $this->db_conection->insert_id;
    }

    public function __destruct() {
        $this->db_conection->close();
    }
}

