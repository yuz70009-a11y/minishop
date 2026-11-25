-- ミニショップ（第18〜27回）のデータベース
-- 実行すると minishop データベースを作り直し、商品5件の状態に戻す
CREATE DATABASE IF NOT EXISTS minishop DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE minishop;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS products;

-- 商品
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    description TEXT NOT NULL
);

-- 会員（パスワードはハッシュにして保存する）
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 注文（1回の注文につき1行）
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 注文の明細（注文した商品1種類につき1行。price は注文したときの価格）
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    price INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (name, price, stock, description) VALUES
('マグカップ', 1200, 10, '毎日使える白いマグカップ。'),
('ノート', 300, 50, 'A5サイズの方眼ノート。'),
('ボールペン', 150, 100, '書きやすい黒のボールペン。'),
('トートバッグ', 2500, 3, '丈夫な帆布のトートバッグ。'),
('ステッカー', 200, 0, 'ノートPCに貼れるステッカー。');
