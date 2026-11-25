<?php
// データベースに接続する。functions.php から読み込まれる
$pdo = new PDO(
    'mysql:host=localhost;dbname=minishop;charset=utf8mb4',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
