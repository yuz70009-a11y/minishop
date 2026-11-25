<?php
// どのページでも最初に読み込む共通ファイル（道具箱）
require_once __DIR__ . '/db.php';
session_start();

// 画面に文字を出すときは必ず通す（XSS対策）
function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// カートに入っている商品の個数の合計（第20回から使う）
function cart_count()
{
    return array_sum($_SESSION['cart'] ?? []);
}

// フォームに埋め込む合言葉（CSRF対策。第20回から使う）
function csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// POSTで、合言葉が正しいときだけ先へ進む（第20回から使う）
function check_post()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('この操作はフォームのボタンから行ってください。');
    }
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || !hash_equals(csrf_token(), $token)) {
        http_response_code(400);
        exit('画面を開き直してから、もう一度操作してください。');
    }
}

// ログインしていなければ、ログイン画面へ移動させる（第25回から使う）
function require_login()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
