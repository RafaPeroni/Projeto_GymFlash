DROP DATABASE gymflash;
CREATE DATABASE gymflash;
USE gymflash;

DROP TABLE CadastroAcademia;
CREATE TABLE CadastroAcademia(
Credencial_academia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Nome_da_academia VARCHAR(55) NOT NULL,
Nome_do_representate VARCHAR(55) NOT NULL,
CNPJ_academia CHAR(18) NOT NULL,
Email_academia VARCHAR(256) NOT NULL,
Senha_academia VARCHAR(32) NOT NULL,
Telefone_academia CHAR(15) NOT NULL,
Quant_funcionario INT NOT NULL,
Comentario VARCHAR(500)
);

DROP TABLE EnderecoAcademia;
CREATE TABLE EnderecoAcademia( 
idEndereco INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
FK_Credencial_academia INT NOT NULL,
CEP_academia CHAR(9),
Num_academia INT NOT NULL,
Rua_academia VARCHAR(45),
Bairro_academia VARCHAR(45),
Cidade_academia VARCHAR(45),
UF_academia CHAR(2),
FOREIGN KEY (FK_Credencial_academia) REFERENCES CadastroAcademia(Credencial_academia)
);

DROP TABLE ModalidadeAcademia;
CREATE TABLE ModalidadeAcademia(idModalidade INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
FK_Credencial_academia INT NOT NULL,
Nome_modalidade VARCHAR(45),
MT_modalidade INT,
BX_modalidade INT,
DC_modalidade INT,
SP_modalidade INT,
JD_modalidade INT,
TK_modalidade INT,
JP_modalidade INT,
CF_modalidade INT,
FOREIGN KEY (FK_Credencial_academia) REFERENCES CadastroAcademia(Credencial_academia)
);

DROP TABLE ExpedienteAcademia;
CREATE TABLE ExpedienteAcademia(
idExpedienteAcademia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
FK_Credencial_academia INT NOT NULL,
Dia_semana INT NOT NULL,
Hora_abertura_academia TIME NOT NULL,
Hora_inicio_intervalo_academia TIME NOT NULL,
Hora_fim_intervalo_academia TIME NOT NULL,
Hora_fechamento_academia TIME NOT NULL,
FOREIGN KEY (FK_Credencial_academia) REFERENCES CadastroAcademia(Credencial_academia)
);
select * from CadastroAcademia;
            