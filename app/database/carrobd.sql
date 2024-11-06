-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/09/2024 às 01:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12
CREATE DATABASE carrobd;
USE carrobd;
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
-- Estrutura para tabela `clientes`
--

CREATE TABLE notificacoes (
    id_notificacao INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    nome_cliente VARCHAR(255),
    texto_mensagem TEXT,
    data_envio DATETIME,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

ALTER TABLE notificacoes
DROP FOREIGN KEY notificacoes_ibfk_1;

-- 2. Renomeie a coluna id_cliente para id_usuario
ALTER TABLE notificacoes
CHANGE id_cliente id_usuario INT;

-- 3. Adicione a nova chave estrangeira com o nome atualizado
ALTER TABLE notificacoes
ADD CONSTRAINT fk_notificacoes_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario);


CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf`, `endereco`, `telefone`, `email`) VALUES
(1, 'João da Silva', '12345678901', 'Rua das Flores, 123', '(11) 99999-1234', 'joao.silva@gmail.com'),
(2, 'Maria Oliveira', '98765432100', 'Avenida Paulista, 1000', '(21) 88888-4321', 'maria.oliveira@hotmail.com'),
(3, 'Carlos Souza', '45678912311', 'Rua XV de Novembro, 300', '(31) 77777-5678', 'carlos.souza@yahoo.com'),
(4, 'Fernanda Lima', '11223344556', 'Alameda Santos, 500', '(41) 66666-6789', 'fernanda.lima@gmail.com'),
(5, 'Paulo Pereira', '99887766554', 'Rua Augusta, 200', '(51) 55555-7890', 'paulo.pereira@outlook.com'),
(6, 'Ana Martins', '22334455667', 'Rua São João, 450', '(61) 44444-8901', 'ana.martins@gmail.com'),
(7, 'Ricardo Santos', '33221100987', 'Avenida Rio Branco, 700', '(71) 33333-9012', 'ricardo.santos@yahoo.com'),
(8, 'Mariana Costa', '77889900123', 'Rua Santa Clara, 234', '(81) 22222-0123', 'mariana.costa@hotmail.com'),
(9, 'Julio Mendes', '66778899009', 'Travessa Boa Vista, 145', '(91) 11111-1234', 'julio.mendes@gmail.com'),
(10, 'Patricia Lopes', '11229933445', 'Rua Padre Eustáquio, 877', '(41) 99999-3456', 'patricia.lopes@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_veiculo`
--

CREATE TABLE `imagens_veiculo` (
  `id_imagem` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `imagem` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagens_veiculo`
--
-- --------------------------------------------------------

--
-- Estrutura para tabela `locacoes`
--

CREATE TABLE `locacoes` (
  `id_locacao` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `locacoes`
--

INSERT INTO `locacoes` (`id_locacao`, `id_cliente`, `id_veiculo`, `data_inicio`, `data_fim`, `valor_total`) VALUES
(1, 1, 1, '2024-09-10', '2024-09-15', 1000.00),
(2, 2, 2, '2024-09-12', '2024-09-17', 1250.00),
(3, 3, 3, '2024-09-15', '2024-09-20', 900.00),
(4, 4, 4, '2024-09-18', '2024-09-22', 600.00),
(5, 5, 5, '2024-09-20', '2024-09-25', 1100.00),
(6, 6, 6, '2024-09-23', '2024-09-28', 800.00),
(7, 7, 7, '2024-09-25', '2024-09-30', 700.00),
(8, 8, 8, '2024-09-28', '2024-10-02', 680.00),
(9, 9, 9, '2024-09-30', '2024-10-04', 760.00),
(10, 10, 10, '2024-10-01', '2024-10-06', 1300.00),
(11, 1, 1, '2024-09-10', '2024-09-15', 1000.00),
(12, 1, 1, '2024-09-10', '2024-09-15', 1000.00),
(13, 1, 1, '2024-09-10', '2024-09-12', 400.00),
(14, 2, 2, '2024-09-10', '2024-09-12', 500.00),
(15, 2, 2, '2024-08-10', '2024-08-11', 250.00),
(16, 2, 2, '2024-05-10', '2024-05-11', 250.00),
(17, 2, 2, '2024-02-10', '2024-02-13', 750.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `manutencoes`
--

CREATE TABLE `manutencoes` (
  `id_manutencao` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `manutencoes`
--

INSERT INTO `manutencoes` (`id_manutencao`, `id_veiculo`, `data_inicio`, `data_fim`, `descricao`) VALUES
(11, 1, '2024-08-01', '2024-08-05', 'Troca de óleo e revisão geral'),
(12, 2, '2024-08-10', '2024-08-15', 'Substituição de pneus e alinhamento'),
(13, 3, '2024-08-20', '2024-08-22', 'Troca de pastilhas de freio'),
(14, 4, '2024-08-25', '2024-08-28', 'Revisão elétrica e troca de bateria'),
(15, 5, '2024-09-01', '2024-09-03', 'Troca do filtro de ar e óleo'),
(16, 6, '2024-09-05', '2024-09-10', 'Revisão completa de 20.000 km'),
(17, 7, '2024-09-12', '2024-09-15', 'Alinhamento e balanceamento'),
(18, 8, '2024-09-18', '2024-09-20', 'Troca de amortecedores e revisão geral'),
(19, 9, '2024-09-22', '2024-09-25', 'Revisão de freios e embreagem'),
(20, 10, '2024-09-30', NULL, 'Manutenção preventiva de 50.000 km');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_pagamento` int(11) NOT NULL,
  `id_locacao` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_pagamento` date NOT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id_pagamento`, `id_locacao`, `valor`, `data_pagamento`, `forma_pagamento`) VALUES
(61, 1, 1000.00, '2024-09-09', 'Cartão de Crédito'),
(62, 2, 1250.00, '2024-09-11', 'Boleto Bancário'),
(63, 3, 900.00, '2024-09-14', 'Pix'),
(64, 4, 750.00, '2024-09-17', 'Transferência Bancária'),
(65, 5, 1100.00, '2024-09-19', 'Cartão de Crédito'),
(66, 6, 800.00, '2024-09-22', 'Cartão de Débito'),
(67, 7, 850.00, '2024-09-24', 'Pix'),
(68, 8, 680.00, '2024-09-27', 'Boleto Bancário'),
(69, 9, 760.00, '2024-09-29', 'Transferência Bancária'),
(70, 10, 1300.00, '2024-09-30', 'Pix');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('admin','cliente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `senha`, `tipo_usuario`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin'),
(2, 'joaosilva', 'abf59c6353549fc56b11464e30aed9bda0bea219f58f5002f90207d5665ec7d8', 'cliente'),
(3, 'mariaoliveira', 'd5d44f8ce08663ab2686744f1f2bac92a90eeb8bf68ec17555a8ac1f82f3252b', 'cliente'),
(4, 'carlossouza', '358c426aee0db03b9efe2abcae721bd1fb60a41362f37249e3038473bf900de7', 'cliente'),
(5, 'fernandalima', '27826c68dec407efb4e35e4c330aa29e9ac135f23644a34c2692b517bea2c6d2', 'cliente'),
(6, 'paulopereira', '2dd7991558fe1d42a1ffe0662fde68b63cb5c44ebe7af4ce66bfccee0e3d1d4e', 'cliente'),
(7, 'anamar', 'b2503d0e500281fc42ee93da28b77ce7b0b09a9711f4792f0a19988ab22c31aa', 'cliente'),
(8, 'ricardos', 'a242472e7b7f2a25e6b3e8d39d6f5f2a84a881612823a199bfcb005d4d117715', 'cliente'),
(9, 'marianac', 'ba60caf277f5a6c36eaf634aff835d48302977ca5493b51d8d6d13dc78dfb7b1', 'cliente'),
(10, 'julio_mendes', '043d15c6d80ebbbf88ed48d8ebdfbfdff2dace27dbd589c73dd85f0f4e268354', 'cliente');

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

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `imagens_veiculo`
--
ALTER TABLE `imagens_veiculo`
  ADD PRIMARY KEY (`id_imagem`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `locacoes`
--
ALTER TABLE `locacoes`
  ADD PRIMARY KEY (`id_locacao`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD PRIMARY KEY (`id_manutencao`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `id_locacao` (`id_locacao`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `imagens_veiculo`
--
ALTER TABLE `imagens_veiculo`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `locacoes`
--
ALTER TABLE `locacoes`
  MODIFY `id_locacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  MODIFY `id_manutencao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagens_veiculo`
--
ALTER TABLE `imagens_veiculo`
  ADD CONSTRAINT `imagens_veiculo_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `locacoes`
--
ALTER TABLE `locacoes`
  ADD CONSTRAINT `locacoes_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `locacoes_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD CONSTRAINT `manutencoes_ibfk_1` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`id_locacao`) REFERENCES `locacoes` (`id_locacao`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
