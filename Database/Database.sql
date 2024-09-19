-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/09/2024 às 17:37
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carrobd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id_veiculo` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `valor_diaria` decimal(10,2) NOT NULL,
  `status` enum('disponível','alugado','manutenção') DEFAULT 'disponível',
  `imagem` longblob DEFAULT NULL,
  `capacidade_pessoas` int(11) NOT NULL,
  `capacidade_bagageiro` decimal(5,2) NOT NULL,
  `cambio` varchar(20) NOT NULL,
  `combustivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id_veiculo`, `marca`, `modelo`, `ano`, `placa`, `valor_diaria`, `status`, `imagem`, `capacidade_pessoas`, `capacidade_bagageiro`, `cambio`, `combustivel`) VALUES
(1, 'Honda', 'Civic', 2020, 'ABC1234', 200.00, 'disponível', NULL, 5, 350.00, 'Automático', 'Gasolina'),
(2, 'Toyota', 'Corolla', 2021, 'DEF5678', 250.00, 'disponível', NULL, 7, 450.00, 'Manual', 'Diesel'),
(3, 'Ford', 'Focus', 2019, 'GHI9012', 180.00, 'disponível', NULL, 4, 250.00, 'Automático', 'Flex'),
(4, 'Chevrolet', 'Onix', 2020, 'JKL3456', 150.00, 'disponível', NULL, 2, 150.00, 'Automático', 'Gasolina'),
(5, 'Volkswagen', 'Golf', 2018, 'MNO7890', 220.00, 'disponível', NULL, 5, 350.00, 'Manual', 'Diesel'),
(6, 'Hyundai', 'HB20', 2022, 'PQR1234', 160.00, 'disponível', NULL, 7, 500.00, 'Automático', 'Gasolina'),
(7, 'Renault', 'Sandero', 2019, 'STU5678', 140.00, 'disponível', NULL, 4, 200.00, 'Manual', 'Flex'),
(8, 'Fiat', 'Argo', 2021, 'VWX9012', 170.00, 'disponível', NULL, 5, 300.00, 'Automático', 'Gasolina'),
(9, 'Peugeot', '208', 2020, 'YZA3456', 190.00, 'disponível', NULL, 6, 400.00, 'Manual', 'Diesel'),
(10, 'Nissan', 'Kicks', 2022, 'BCD7890', 260.00, 'disponível', NULL, 4, 250.00, 'Automático', 'Flex');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
