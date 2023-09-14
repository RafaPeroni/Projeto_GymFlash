Create database gymflash;
Use gymflash;


create table nome(
id int not null auto_increment primary key,
nick varchar(80) not null,
senha int not null,
funcao varchar(80) not null
);
select * FROM nome;

create table CadastroAcademia(
Credencial_academia int not null primary key auto_increment,
Nome_da_academia varchar(55) not null,
Nome_do_representate varchar(55) not null,
CNPJ_academia varchar(14) not null,    -- apenas números
Email_academia varchar(256) not null,
Senha_academia char(8) not null,
Telefone_academia char(12) not null,   -- considerando o Hífen 
Quant_funcionario int not null,
Comentario varchar(500),
Endereco_da_foto_academia varchar(256) 
);
Select Email_academia, CNPJ_academia  from cadastroacademia;
select* FROM  cadastroacademia;
 INSERT INTO CadastroAcademia(Credencial_academia,
							  Nome_da_academia,	
                              Nome_do_representate,	
                              CNPJ_academia,		
                              Email_academia,	
                              Senha_academia,	
                              Telefone_academia,	
                              Quant_funcionario,
                              Comentario,Endereco_da_foto_academia)
			VALUE(1,"ARENA","RAQFAEEL",'12345678912345',"RAFAEL@GMAIL","1","123456789123",0,"OLA","ABC");

create table EnderecoAcademia(
idEndereco int not null auto_increment primary key,
FK_Credencial_academia int not null,
CEP_academia char(9), -- considereando o Hífen
Num_academia int not null,
Rua_academia varchar(45),
Bairro_academia varchar(45),
Cidade_academia varchar(45),
UF_academia char(2),
Complemento_academia varchar(4),
foreign key (FK_Credencial_academia) references CadastroAcademia(Credencial_academia)
);
Select * from enderecoacademia;


Create table ModalidadeAcademia(
idModalidade int not null primary key auto_increment,
FK_Credencial_academia int not null,
Nome_modalidade varchar(45),
P_N_modalidade int, -- Possui ou não 0=F / 1=V
foreign key (FK_Credencial_academia) references CadastroAcademia(Credencial_academia)
);
select * from modalidadeacademia;

Create table ExpedienteAcademia(
idExpedienteAcademia int not null primary key auto_increment,
FK_Credencial_academia int not null,
Dia_semana int not null, -- sendo 1 para segunda e 7 para domingo
Hora_abertura_academia time not null,
Hora_inicio_intervalo_academia time not null,
Hora_fim_intervalo_academia time not null,
Hora_fechamento_academia time not null,
foreign key (FK_Credencial_academia) references CadastroAcademia(Credencial_academia)
);

