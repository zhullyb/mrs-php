<?php
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $originalFileName = $_FILES['file']['name'];
    $tempFilePath = $_FILES['file']['tmp_name'];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $uniqueFileName = time() . '_' . mt_rand(1000, 9999) . '.' . $fileExtension;
    $uploadFolder = 'uploads/';
    if (!file_exists($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }
    $destination = $uploadFolder . $uniqueFileName;

    $baseURL = 'http://localhost:8080/';

    if (move_uploaded_file($tempFilePath, $destination)) {
        echo json_encode([
            'url' => $baseURL . $destination,
        ]);
    } else {
        echo json_encode([
            'error' => '上传失败',
        ]);
    }
}