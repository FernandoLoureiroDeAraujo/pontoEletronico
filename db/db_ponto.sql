CREATE DATABASE db_ponto;

USE db_ponto;

CREATE TABLE tbl_dadosFuncionario	     -- Dados do Funcionário
(
Func_CPF BIGINT(12) NOT NULL UNIQUE,
Nome VARCHAR(70) NOT NULL,
PRIMARY KEY (Func_CPF)
)
ENGINE = INNODB DEFAULT CHARSET = UTF8;

CREATE TABLE tbl_registroFuncionario      -- Dados Ponto
(
Cod_rf INT(6) NOT NULL UNIQUE AUTO_INCREMENT,
Data DATE NOT NULL,
Entrada1 TIME,
Saida1 TIME,
Entrada2 TIME,
Saida2 TIME,
TotalHoras TIME,
HorasExtra TIME,
HorasDeficit TIME,
Func_CPF BIGINT(12) NOT NULL,
PRIMARY KEY (Cod_rf), 
CONSTRAINT fkfuncionario_registro FOREIGN KEY (Func_CPF) 
REFERENCES tbl_dadosFuncionario (Func_CPF)
)
ENGINE = INNODB DEFAULT CHARSET = UTF8;


-- Select simples apenas em uma tabela por CPF
SELECT Nome, Func_CPF FROM tbl_dadosFuncionario WHERE Func_CPF = 51

-- Select simples apenas em uma tabela por CPF, pegando os campos data e hora.
SELECT Data, Hora FROM tbl_registroFuncionario WHERE Func_CPF = 51
ORDER BY tbl_registroFuncionario.Data ASC, tbl_registroFuncionario.Hora ASC

-- Select usando duas tabelas por CPF
SELECT tbl_dadosFuncionario.Nome, tbl_dadosFuncionario.Func_CPF, tbl_registroFuncionario.Data, tbl_registroFuncionario.Hora  
FROM tbl_dadosFuncionario 
INNER JOIN tbl_registroFuncionario ON tbl_dadosFuncionario.Func_CPF = tbl_registroFuncionario.Func_CPF 
WHERE tbl_registroFuncionario.Func_CPF  = 51
ORDER BY tbl_registroFuncionario.Data ASC, tbl_registroFuncionario.Hora ASC