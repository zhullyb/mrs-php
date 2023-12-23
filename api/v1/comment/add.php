<?php

$data = json_decode(file_get_contents('php://input'), true);
$uid = $_SESSION['uid'];

if (empty($data['mid']) || empty($data['content']) || empty($data['rate'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}
    
$sql = "INSERT INTO comments (mid, uid, comment, rate) VALUES ($data[mid], $uid, '$data[content]', $data[rate])";
if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
    ]);
} else {
    echo json_encode([
        'code' => 400,
        'msg' => '添加失败',
    ]);
}