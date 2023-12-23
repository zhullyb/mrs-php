<?php
$uid = $_SESSION['uid'];
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