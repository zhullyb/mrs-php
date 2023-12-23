<?php
// 展示所有电影
$sql = "SELECT * FROM movieinfo";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $result = $res->fetch_all(MYSQLI_ASSOC);
    foreach ($result as $item) {
        if (empty($item['image'])) {
            $item['image'] = 'https://i0.wp.com/http.cat/404';
        }
        $sql = "SELECT AVG(rate) FROM comments WHERE mid = {$item['mid']}";
        $res = $conn->query($sql);
        $rate = $res->fetch_row()[0];
        if (empty($rate)) {
            $rate = 0;
        }
        $data[] = [
            'name' => $item['name'],
            'image' => $item['image'],
            'mid' => $item['mid'],
            'rate' => round((float)$rate, 1),
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