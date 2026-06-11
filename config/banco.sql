CREATE DATABASE agenda;
/*-----------------------------------------------------------------------------------------------------------------------------------------------------*/

CREATE TABLE contatos(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100),
    email VARCHAR(100),
    telefone VARCHAR(14),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
)

/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/

create table clientes(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR (100),
	cpf VARCHAR (14) UNIQUE,
    email VARCHAR (100),
    telefone VARCHAR (14),
	endereco VARCHAR (150),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/

create table produtos(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (100),
    decricao VARCHAR(150),
    preco DECIMAL (10,2),
    estoque INT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE produtos ADD imagem VARCHAR (255) null;

/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/

INSERT INTO produtos (nome, decricao, preco, estoque) VALUES ('Notebook Ultra', 'Notebook com processador i7, 16GB RAM, SSD 512GB', 4599.99, 15);

INSERT INTO produtos (nome, decricao, preco, estoque) VALUES ('Mouse Gamer', 'Mouse com RGB, 6 botões programáveis e 6400 DPI', 89.90, 50);

INSERT INTO produtos (nome, decricao, preco, estoque) VALUES ('Teclado Mecânico', 'Teclado mecânico com switch azul, iluminação RGB', 199.99, 30);

INSERT INTO produtos (nome, decricao, preco, estoque) VALUES ('Monitor 24"', 'Monitor LED Full HD, 75Hz, 1ms de resposta', 899.90, 12);

/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/

INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES ('João Silva Santos', '123.456.789-00', 'joao.silva@email.com', '(11) 98765-4321', 'Rua das Flores, 123 - São Paulo, SP');

INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES ('Maria Oliveira Souza', '987.654.321-00', 'maria.oliveira@email.com', '(21) 99876-5432', 'Av. Brasil, 456 - Rio de Janeiro, RJ');

INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES ('Carlos Eduardo Lima', '456.789.123-00', 'carlos.lima@email.com', '(31) 98765-1234', 'Rua dos Programadores, 789 - Belo Horizonte, MG');

INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES ('Ana Paula Costa', '789.123.456-00', 'ana.costa@email.com', '(41) 99988-7766', 'Praça Central, 100 - Curitiba, PR');

/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/

INSERT INTO contatos (nome, email, telefone) VALUES ('Pedro Henrique Alves', 'pedro.alves@email.com', '(11) 91234-5678');

INSERT INTO contatos (nome, email, telefone) VALUES ('Fernanda Lima Costa', 'fernanda.lima@email.com', '(21) 92345-6789');

INSERT INTO contatos (nome, email, telefone) VALUES ('Roberto Santos Melo', 'roberto.melo@email.com', '(31) 93456-7890');

INSERT INTO contatos (nome, email, telefone) VALUES ('Juliana Pereira Rocha', 'juliana.rocha@email.com', '(41) 94567-8901');

INSERT INTO contatos (nome, email, telefone) VALUES ('Emily Helena Costa Pereira', 'emily_h_pereira@email.com', '(44) 99706-3382');