<?php

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['mid']) || empty($data['name']) || empty($data['description'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$name = $conn->real_escape_string($data['name']);
$image = $conn->real_escape_string($data['image']);
$director = $conn->real_escape_string($data['director']);
$screenwriter = $conn->real_escape_string($data['screenwriter']);
$mainActor = $conn->real_escape_string($data['mainActor']);
$type = $conn->real_escape_string($data['type']);
$website = $conn->real_escape_string($data['website']);
$country = $conn->real_escape_string($data['country']);
$language = $conn->real_escape_string($data['language']);
$releaseDate = $conn->real_escape_string($data['releaseDate']);
$length = $conn->real_escape_string($data['length']);
$description = $conn->real_escape_string($data['description']);
$mid = $conn->real_escape_string($data['mid']);

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
