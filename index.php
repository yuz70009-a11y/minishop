
<?php
require_once __DIR__ . '/functions.php';

// TODO 18-1: products から id・name・price を id の順にすべて取り出し、$products に入れる
$products = [];
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
        <?php // TODO 18-2: $products を foreach で1件ずつ取り出し、商品名と価格を li で表示する ?>
    </ul>
</body>
</html>
