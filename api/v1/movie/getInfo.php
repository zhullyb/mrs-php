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
    $data = [];
    foreach ($result as $item) {
        if (empty($item['image'])) {
            $item['image'] = 'https://i0.wp.com/http.cat/404';
        }
        if (empty($item['rate'])) {
            $item['rate'] = 0;
        }
        $data[] = $item;
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