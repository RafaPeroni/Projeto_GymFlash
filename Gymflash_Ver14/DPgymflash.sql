Create database gymflash;
Use gymflash;

CREATE TABLE Cadastrousuario(
Credencial_usuario  int not null primary key auto_increment,
Nome_usuario varchar(55) not null,
CPF_usuario varchar(18) not null,    -- apenas números
Email_usuario varchar(256) not null,
Senha_usuario char(8) not null,
Telefone_usuario char(14) not null   -- considerando o Hífen 
);
SELECT * FROM Cadastrousuario;

create table CadastroAcademia(
Credencial_academia int not null primary key auto_increment,
Nome_da_academia varchar(55) not null,
Nome_do_representate varchar(55) not null,
CNPJ_academia varchar(18) not null,    -- apenas números
Email_academia varchar(256) not null,
Senha_academia char(8) not null,
Telefone_academia char(14) not null,   -- considerando o Hífen 
Quant_funcionario int not null,
Comentario varchar(500)
);
 
select* FROM  cadastroacademia;

Create table Avaliacao(
id_estrelas int not null primary key auto_increment,
qnt_estrelas int not null,
id_persona  int not null ,
FK_Credencial_academia int not null,
foreign key (FK_Credencial_academia) references CadastroAcademia(Credencial_academia)
);

create table EnderecoAcademia(
idEndereco int not null auto_increment primary key,
FK_Credencial_academia int not null,
CEP_academia char(9), -- considereando o Hífen
Num_academia int not null,
Rua_academia varchar(45),
Bairro_academia varchar(45),
Cidade_academia varchar(45),
Estado_academia varchar(45),
Complemento_academia varchar(100),
foreign key (FK_Credencial_academia) references CadastroAcademia(Credencial_academia)
);
Select * from enderecoacademia;


CREATE TABLE ModalidadeAcademia(
id_modaldiade int not null ,
FK_Credencial_academia INT NOT NULL,
Nome_modalidade VARCHAR(45),
FOREIGN KEY (FK_Credencial_academia) REFERENCES CadastroAcademia(Credencial_academia)
);

Create table ExpedienteAcademia(

FK_Credencial_academia int not null,
Dia_semana int not null, -- sendo 1 para segunda e 7 para domingo
estatus varchar(15),
Hora_abertura_academia time not null,
Hora_fechamento_academia time not null,
foreign key (FK_Credencial_academia) references CadastroAcademia(Credencial_academia)
);
select * FROM ExpedienteAcademia;
select* FROM  cadastroacademia;
Select * from enderecoacademia;
select * from ModalidadeAcademia;
select * from Avaliacao;

DROP TABLE ModalidadeAcademia;


