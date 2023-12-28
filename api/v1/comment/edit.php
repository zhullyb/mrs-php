<?php
$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['cid']) || empty($data['content']) || empty($data['rate'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数错误',
    ]);
    exit();
} 

$uid = $_SESSION['uid'];

$sql = "SELECT uid FROM `comments` WHERE cid = '$data[cid]'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if ($row['uid'] == $uid || isAdmin($conn, $uid)) {
        $content = $conn->real_escape_string($data['content']);
        $rate = $conn->real_escape_string($data['rate']);
        $cid = $conn->real_escape_string($data['cid']);

        $sql2 = "UPDATE `comments` SET comment = '$content', rate = '$rate' WHERE cid = '$cid'";
        if ($conn->query($sql2)) {
            echo json_encode([
                'code' => 200,
                'msg' => 'success',
            ]);
        } else {
            echo json_encode([
                'code' => 500,
                'msg' => '修改失败',
            ]);
        }
    } else {
        echo json_encode([
            'code' => 401,
            'msg' => '权限不足',
        ]);
    }
} else {
    echo json_encode([
        'code' => 404,
        'msg' => '评论不存在',
    ]);
}