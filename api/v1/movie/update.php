<?php

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['mid']) || empty($data['name']) || empty($data['description'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$sql = "UPDATE movieinfo SET name = '$data[name]', image = '$data[image]', director = '$data[director]', screenwriter = '$data[screenwriter]', mainActor = '$data[mainActor]', type = '$data[type]', website = '$data[website]', country = '$data[country]', language = '$data[language]', releaseDate = '$data[releaseDate]', length = '$data[length]', description = '$data[description]' WHERE mid = $data[mid]";
if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
    ]);
} else {
    echo json_encode([
        'code' => 400,
        'msg' => '更新失败',
    ]);
}
