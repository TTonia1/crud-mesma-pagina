CREATE DATABASE sistema_pedidos;

USE sistema_pedidos;

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(255) NOT NULL,
    nome_produto VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    data_pedido DATE NOT NULL
);

select * from pedidos;