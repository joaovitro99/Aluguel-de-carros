CREATE DATABASE carrobd;
USE carrobd;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE usuarios
MODIFY tipo_usuario ENUM('admin', 'cliente', 'funcionario') NOT NULL;
INSERT INTO usuarios (id_usuario, nome_usuario, senha, tipo_usuario)
VALUES (14, 'João Silva', 'senha123', 'funcionario');
