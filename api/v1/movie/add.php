<?php

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['name']) || empty($data['description'])) {
    echo json_encode([
        'code' => 400,
        'msg' => '参数不全',
    ]);
    exit();
}

$sql = "INSERT INTO movieinfo (name, image, director, screenwriter, mainActor, type, website, country, language, releaseDate, length, description) VALUES ('$data[name]', '$data[image]', '$data[director]', '$data[screenwriter]', '$data[mainActor]', '$data[type]', '$data[website]', '$data[country]', '$data[language]', '$data[releaseDate]', '$data[length]', '$data[description]')";
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