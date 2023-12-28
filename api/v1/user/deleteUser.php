<?php
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['uid'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$uid = $conn->real_escape_string($data['uid']);
$sql = "DELETE FROM userinfo WHERE uid = '$uid'";
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