<?php
$keyword = $conn->real_escape_string($_GET['keyword']);

if (empty($keyword)) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数错误',
    ]);
    exit();
}

// 返回 name, rate(从 comments 表中查，取平均值), description,image, mid
$sql = "SELECT * FROM movieinfo WHERE name LIKE '%$keyword%'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $result = $res->fetch_all(MYSQLI_ASSOC);
    $data = [];
    foreach ($result as $item) {
        $sql2 = "SELECT AVG(rate) AS rate FROM comments WHERE mid = '$item[mid]'";
        $res2 = $conn->query($sql2);
        $rate = $res2->fetch_all(MYSQLI_ASSOC);
        if (empty($item['image'])) {
            $item['image'] = 'https://i0.wp.com/http.cat/404';
        }
        if (empty($rate[0]['rate'])) {
            $rate[0]['rate'] = 0;
        }
        $data[] = [
            'name' => $item['name'],
            'rate' => round((float)$rate[0]['rate'], 1),
            'description' => $item['description'],
            'image' => $item['image'],
            'mid' => $item['mid'],
        ];
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