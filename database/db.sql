
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    variacao VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_produtos_preco CHECK (preco >= 0)
);


CREATE TABLE estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INTEGER NOT NULL UNIQUE, 
    quantidade INTEGER NOT NULL DEFAULT 0,
    CONSTRAINT fk_estoque_produto
        FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE, 
    CONSTRAINT chk_estoque_quantidade CHECK (quantidade >= 0)
);


CREATE TABLE cupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    desconto_percentual DECIMAL(5,2) NOT NULL,
    validade DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_cupons_desconto_percentual CHECK (desconto_percentual >= 0 AND desconto_percentual <= 100)
);


CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_pedido TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cliente_nome VARCHAR(100) NOT NULL,
    cupom_id INTEGER,
    status VARCHAR(50) NOT NULL DEFAULT 'pendente',
    CONSTRAINT fk_pedidos_cupom
        FOREIGN KEY (cupom_id) REFERENCES cupons(id) ON DELETE SET NULL,
    CONSTRAINT chk_pedidos_status CHECK (status IN ('pendente', 'processando', 'enviado', 'entregue', 'cancelado'))
);


CREATE TABLE item_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INTEGER NOT NULL,
    produto_id INTEGER NOT NULL,
    quantidade INTEGER NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL, 
    CONSTRAINT fk_item_pedido_pedido
        FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE, 
    CONSTRAINT fk_item_pedido_produto
        FOREIGN KEY (produto_id) REFERENCES produtos(id),
    CONSTRAINT chk_item_pedido_quantidade CHECK (quantidade > 0),
    CONSTRAINT chk_item_pedido_preco_unitario CHECK (preco_unitario >= 0)
);


CREATE INDEX idx_estoque_produto_id ON estoque (produto_id);
CREATE INDEX idx_pedidos_cupom_id ON pedidos (cupom_id);
CREATE INDEX idx_item_pedido_pedido_id ON item_pedido (pedido_id);
CREATE INDEX idx_item_pedido_produto_id ON item_pedido (produto_id);
