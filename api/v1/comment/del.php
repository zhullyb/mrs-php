<?php
$cid = $conn->real_escape_string($_GET['cid']);
$uid = $_SESSION['uid'];

if (empty($cid)) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数错误',
    ]);
    exit();
}

$sql = "SELECT uid FROM `comments` WHERE cid = '$cid'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if ($row['uid'] == $uid || isAdmin($conn, $uid)) {
        $sql2 = "DELETE FROM `comments` WHERE cid = '$cid'";
        if ($conn->query($sql2)) {
            echo json_encode([
                'code' => 200,
                'msg' => 'success',
            ]);
        } else {
            echo json_encode([
                'code' => 500,
                'msg' => '删除失败',
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