<?php
$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['username']) || empty($data['password']) || empty($data['email'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$sql = "SELECT * FROM userinfo WHERE username = '$data[username]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo json_encode([
        'code' => 409,
        'msg' => '该用户名已被注册',
    ]);
    exit();
}

$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
$username = $conn->real_escape_string($data['username']);
$email = $conn->real_escape_string($data['email']);
$sql = "INSERT INTO userinfo (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
if ($conn->query($sql) === TRUE) {
    $uid = $conn->insert_id;
    $_SESSION['uid'] = $uid;
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
        'data' => [
            'uid' => $uid,
            'username' => $data['username'],
            'email' => $data['email'],
            'level' => 0,
        ]
    ]);
}