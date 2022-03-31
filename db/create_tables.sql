create table contato
(
    id       serial
        primary key,
    telefone varchar(255),
    celular  varchar(255),
    email    varchar(255)
);

create table endereco
(
    id          serial
        primary key,
    cep         varchar(255) not null,
    logradouro  varchar(255) not null,
    numero      varchar(255) not null,
    bairro      varchar(255) not null,
    municipio   varchar(255) not null,
    complemento varchar(255)
);

create table cidadao
(
    id              serial
        primary key,
    cpf             varchar(255),
    nome            varchar(255),
    data_nascimento date,
    contato_id      integer
        references contato
        endereco_id integer
        references endereco
);
