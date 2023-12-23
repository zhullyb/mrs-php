<?php
$mid = $_GET['mid'];

if (empty($mid)) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数错误',
    ]);
    exit();
}

$sql = "SELECT * FROM movieinfo WHERE mid = '$mid'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $result = $res->fetch_all(MYSQLI_ASSOC);
    $data = $result[0];
    if (empty($data['image'])) {
        $data['image'] = 'https://i0.wp.com/http.cat/404';
    }
    $sql = "SELECT AVG(rate) FROM comments WHERE mid = '$mid'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $result = $res->fetch_all(MYSQLI_ASSOC);
        $data['rate'] = $result[0]['AVG(rate)'];
    } 
    if (empty($data['rate'])) {
        $data['rate'] = 0;
    }
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
        'data' => $data
    ]);
} else {
    echo json_encode([
        'code' => 404,
        'msg' => '电影不存在',
    ]);
}