<?php

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['mid']) || empty($data['name']) || empty($data['description'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$escapeWithEmptyCheck = function($conn, $key, $data) {
    return isset($data[$key]) ? $conn->real_escape_string($data[$key]) : '';
};

$name = $escapeWithEmptyCheck($conn, 'name', $data);
$image = $escapeWithEmptyCheck($conn, 'image', $data);
$director = $escapeWithEmptyCheck($conn, 'director', $data);
$screenwriter = $escapeWithEmptyCheck($conn, 'screenwriter', $data);
$mainActor = $escapeWithEmptyCheck($conn, 'mainActor', $data);
$type = $escapeWithEmptyCheck($conn, 'type', $data);
$website = $escapeWithEmptyCheck($conn, 'website', $data);
$country = $escapeWithEmptyCheck($conn, 'country', $data);
$language = $escapeWithEmptyCheck($conn, 'language', $data);
$releaseDate = $escapeWithEmptyCheck($conn, 'releaseDate', $data);
$length = $escapeWithEmptyCheck($conn, 'length', $data);
$description = $escapeWithEmptyCheck($conn, 'description', $data);
$mid = $escapeWithEmptyCheck($conn, 'mid', $data);

$sql = "UPDATE movieinfo SET name = '$name', image = '$image', director = '$director', screenwriter = '$screenwriter', mainActor = '$mainActor', type = '$type', website = '$website', country = '$country', language = '$language', releaseDate = '$releaseDate', length = '$length', description = '$description' WHERE mid = '$mid'";
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
