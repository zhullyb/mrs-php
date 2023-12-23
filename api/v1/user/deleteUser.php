<?php
$uid = $_SESSION['uid'];
$data = json_decode(file_get_contents('php://input'), true);

if (empty($uid)) {
    echo json_encode([
        'code' => 401,
        'msg' => '登陆过期',
    ]);
    exit();
}

if (!isAdmin($conn, $uid)) {
    echo json_encode([
        'code' => 403,
        'msg' => '无权限',
    ]);
    exit();
}

if (empty($data['uid'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$sql = "DELETE FROM userinfo WHERE uid = $data[uid]";
if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
    ]);
} else {
    echo json_encode([
        'code' => 400,
        'msg' => '删除失败',
    ]);
}