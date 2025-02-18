-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/02/2025 às 17:46
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
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nome` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nome`) VALUES
(1, 'Prod - Limpeza'),
(2, 'Prod - Bebida');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fone`
--

CREATE TABLE `fone` (
  `idFone` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `tel` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fone`
--

INSERT INTO `fone` (`idFone`, `id_Pessoa`, `tel`) VALUES
(1, 1, '75983717345'),
(2, 1, '75981127108');

-- --------------------------------------------------------

--
-- Estrutura para tabela `local_arm`
--

CREATE TABLE `local_arm` (
  `idLocal_arm` int(11) NOT NULL,
  `local` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `local_arm`
--

INSERT INTO `local_arm` (`idLocal_arm`, `local`) VALUES
(1, 'Freezer'),
(2, 'Prateleira'),
(3, 'Armazem');

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `idMov` int(11) NOT NULL,
  `idTra` int(11) NOT NULL,
  `idPessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mov_produto`
--

CREATE TABLE `mov_produto` (
  `idMov` int(11) NOT NULL,
  `codBarras` bigint(20) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_Pessoa` int(11) NOT NULL,
  `idTipo_pessoa` int(11) NOT NULL,
  `nome` longtext NOT NULL,
  `cnpj_cpf` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`id_Pessoa`, `idTipo_pessoa`, `nome`, `cnpj_cpf`) VALUES
(1, 1, 'Roberto Carlos Spinola Júnior', '095.485.325.30'),
(2, 2, 'Mercadinho Super-Mario', '88.841.936/0001-96');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `codBarras` bigint(20) NOT NULL,
  `nome` longtext NOT NULL,
  `validade` date NOT NULL,
  `quantidade` int(11) NOT NULL,
  `idLocal_arm` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`codBarras`, `nome`, `validade`, `quantidade`, `idLocal_arm`, `idCategoria`) VALUES
(7890000000000, 'Coca-Cola', '2026-02-18', 200, 1, 2),
(7890000000001, 'Sabão em Pó', '2034-07-12', 250, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipopessoa`
--

CREATE TABLE `tipopessoa` (
  `idTipo` int(11) NOT NULL,
  `nome` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipopessoa`
--

INSERT INTO `tipopessoa` (`idTipo`, `nome`) VALUES
(1, 'Fisica-CPF'),
(2, 'Juridica-CNPJ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacao`
--

CREATE TABLE `transacao` (
  `idTra` int(11) NOT NULL,
  `nome` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `transacao`
--

INSERT INTO `transacao` (`idTra`, `nome`) VALUES
(1, 'Debito'),
(2, 'Credito');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices de tabela `fone`
--
ALTER TABLE `fone`
  ADD PRIMARY KEY (`idFone`),
  ADD KEY `tel` (`tel`(768)),
  ADD KEY `id_Pessoa` (`id_Pessoa`);

--
-- Índices de tabela `local_arm`
--
ALTER TABLE `local_arm`
  ADD PRIMARY KEY (`idLocal_arm`);

--
-- Índices de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`idMov`),
  ADD KEY `cnpj_cpf` (`idPessoa`),
  ADD KEY `idTra` (`idTra`);

--
-- Índices de tabela `mov_produto`
--
ALTER TABLE `mov_produto`
  ADD PRIMARY KEY (`idMov`,`codBarras`),
  ADD KEY `codBarras` (`codBarras`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_Pessoa`),
  ADD KEY `idTipo_pessoa` (`idTipo_pessoa`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codBarras`),
  ADD KEY `idLocal_arm` (`idLocal_arm`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Índices de tabela `tipopessoa`
--
ALTER TABLE `tipopessoa`
  ADD PRIMARY KEY (`idTipo`);

--
-- Índices de tabela `transacao`
--
ALTER TABLE `transacao`
  ADD PRIMARY KEY (`idTra`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `fone`
--
ALTER TABLE `fone`
  MODIFY `idFone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `local_arm`
--
ALTER TABLE `local_arm`
  MODIFY `idLocal_arm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `idMov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_Pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipopessoa`
--
ALTER TABLE `tipopessoa`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `transacao`
--
ALTER TABLE `transacao`
  MODIFY `idTra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `fone`
--
ALTER TABLE `fone`
  ADD CONSTRAINT `fone_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`);

--
-- Restrições para tabelas `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`idTra`) REFERENCES `transacao` (`idTra`),
  ADD CONSTRAINT `movimentacao_ibfk_2` FOREIGN KEY (`idMov`) REFERENCES `mov_produto` (`idMov`),
  ADD CONSTRAINT `movimentacao_ibfk_3` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`id_Pessoa`);

--
-- Restrições para tabelas `mov_produto`
--
ALTER TABLE `mov_produto`
  ADD CONSTRAINT `mov_produto_ibfk_1` FOREIGN KEY (`codBarras`) REFERENCES `produto` (`codBarras`);

--
-- Restrições para tabelas `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_2` FOREIGN KEY (`idTipo_pessoa`) REFERENCES `tipopessoa` (`idTipo`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`idLocal_arm`) REFERENCES `local_arm` (`idLocal_arm`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
