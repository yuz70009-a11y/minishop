<?php
require_once __DIR__ . '/functions.php';
check_post();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 99]]);
if (!$id || !$quantity) {
    http_response_code(400);
    exit('商品または個数が正しくありません。');
}


// 存在しない商品はカートに入れない
$stmt = $pdo->prepare('SELECT id FROM products WHERE id = ?');
$stmt->execute([$id]);
if (!$stmt->fetch()) {
    http_response_code(404);
    exit('商品が見つかりません。');
}

$_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $quantity;


header('Location: product.php?id=' . $id . '&added=1');
exit;
