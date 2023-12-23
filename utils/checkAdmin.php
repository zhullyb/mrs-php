<?php
require_once __DIR__ . '/checkLogin.php';

if (!isAdmin($conn, $_SESSION['uid'])) {
    echo json_encode([
        'code' => 403,
        'msg' => '无权限',
    ]);
    exit();
}