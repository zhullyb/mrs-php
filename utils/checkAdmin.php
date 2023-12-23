<?php
if (empty($_SESSION['uid'])) {
    echo json_encode([
        'code' => 401,
        'msg' => '登陆过期',
    ]);
    exit();
}

if (!isAdmin($conn, $_SESSION['uid'])) {
    echo json_encode([
        'code' => 403,
        'msg' => '无权限',
    ]);
    exit();
}