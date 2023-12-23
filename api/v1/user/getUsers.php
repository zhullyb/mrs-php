<?php

$sql = "SELECT uid, username, email, level FROM userinfo";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
        'data' => $data,
    ]);
} else {
    echo json_encode([
        'code' => 400,
        'msg' => '查询失败',
    ]);
}