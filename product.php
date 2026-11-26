<?php
require_once __DIR__ . '/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    http_response_code(404);
    exit('商品が見つかりません。');
}

$stmt = $pdo->prepare('SELECT id, name, price, stock, description FROM products WHERE id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) {
    http_response_code(404);
    exit('商品が見つかりません。');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= h($product['name']) ?> | ミニショップ</title>
</head>
<body>
    <?php require __DIR__ . '/nav.php'; ?>
    <h1><?= h($product['name']) ?></h1>
    <p>価格：<?= number_format($product['price']) ?>円</p>
    <p>在庫：<?= (int) $product['stock'] ?>個</p>
    <p><?= h($product['description']) ?></p>
    <p><a href="index.php">商品一覧へ戻る</a></p>
</body>
</html>
