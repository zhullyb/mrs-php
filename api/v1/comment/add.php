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
    
$mid = $conn->real_escape_string($data['mid']);
$comment = $conn->real_escape_string($data['content']);
$rate = $conn->real_escape_string($data['rate']);

$sql = "INSERT INTO comments (mid, uid, comment, rate) VALUES ('$mid', $uid, '$comment', '$rate')";
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