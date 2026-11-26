<?php
require_once __DIR__ . '/functions.php';

$stmt = $pdo->query('SELECT id, name, price FROM products ORDER BY id');
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧 | ミニショップ</title>
</head>
<body>
    <?php require __DIR__ . '/nav.php'; ?>
    <h1>商品一覧</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><a href="product.php?id=<?= (int) $product['id'] ?>"><?= h($product['name']) ?></a>（<?= number_format($product['price']) ?>円）</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
