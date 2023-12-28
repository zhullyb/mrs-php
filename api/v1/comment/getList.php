<?php
$mid = $conn->real_escape_string($_GET['mid']);

if (empty($mid)) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数错误',
    ]);
    exit();
}

function email2avatar($email) {
    $hash = md5(strtolower(trim($email)));
    return 'https://cravatar.cn/avatar/' . $hash;
}

$sql = "SELECT * FROM `comments` WHERE mid = '$mid'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $uid = $row['uid'];
        $sql2 = "SELECT * FROM `userinfo` WHERE uid = '$uid'";
        $res2 = $conn->query($sql2);
        $row2 = $res2->fetch_assoc();
        $data[] = [
            'uid' => $row['uid'],
            'rate' => $row['rate'],
            'cid' => $row['cid'],
            'content' => $row['comment'],
            'datetime' => strtotime($row['created_time']),
            'author' => $row2['username'],
            'avatar' => email2avatar($row2['email'])
        ];
    }
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
        'data' => $data,
    ]);
} else {
    echo json_encode([
        'code' => 200,
        'msg' => 'no comments for now',
        'data' => [],
    ]);
}