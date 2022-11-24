create table cidadao
(
    id              serial primary key,
    cpf             varchar(255),
    nome            varchar(255),
    data_nascimento date
);
create table endereco (
end_cod serial primary key,
end_cid integer ,
end_cep  varchar (9),
end_logradouro varchar (60),
end_numero  varchar (9),
end_complemento varchar (60),
end_bairro varchar (60),
end_cidade varchar (60),
end_uf varchar (2),
end_ibge varchar (7),
end_gia varchar (4),
end_ddd  varchar (3),
end_siafi  varchar (4),
foreign Key(end_cid) references cidadao( id ));

create table contato (
contato_cod serial primary key,
contato_cid  integer,
email varchar (180),
celular  varchar (20),
foreign Key(contato_cid) references cidadao( id ));


