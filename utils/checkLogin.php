<?php
if (empty($_SESSION['uid'])) {
    echo json_encode([
        'code' => 401,
        'msg' => '登陆过期',
    ]);
    exit();
}