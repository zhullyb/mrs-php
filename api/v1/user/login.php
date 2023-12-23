<?php
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['username']) || empty($data['password'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

$sql = "SELECT * FROM userinfo WHERE username = '$data[username]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($data['password'], $row['password'])) {
        $_SESSION['uid'] = $row['uid'];
        echo json_encode([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'uid' => $row['uid'],
                'username' => $row['username'],
                'email' => $row['email'],
                'level' => (int)$row['level'],
            ]
        ]);
    } else {
        echo json_encode([
            'code' => 401,
            'msg' => '密码错误',
        ]);
    }
} else {
    echo json_encode([
        'code' => 404,
        'msg' => '该用户名不存在',
    ]);
}