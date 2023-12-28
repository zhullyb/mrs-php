<?php
$mid = $conn->real_escape_string($_GET['mid']);

if (empty($mid)) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数错误',
    ]);
    exit();
}

$sql = "SELECT mid FROM movieinfo WHERE mid = '$mid'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $sql2 = "DELETE FROM movieinfo WHERE mid = '$mid'";
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
        'code' => 404,
        'msg' => '电影不存在',
    ]);
}