<?php

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['name']) || empty($data['description'])) {
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

$sql = "INSERT INTO movieinfo (name, image, director, screenwriter, mainActor, type, website, country, language, releaseDate, length, description) VALUES ('$name', '$image', '$director', '$screenwriter', '$mainActor', '$type', '$website', '$country', '$language', '$releaseDate', '$length', '$description')";
if ($conn->query($sql) === TRUE) {
    $mid = $conn->insert_id;
    echo json_encode([
        'code' => 200,
        'msg' => 'success',
        'data' => [
            'mid' => $mid
        ]
    ]);
}