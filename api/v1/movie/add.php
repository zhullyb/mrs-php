<?php

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['name']) || empty($data['description'])) {
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