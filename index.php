<?php
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
ini_set('session.gc_maxlifetime', 60*60*24);
session_start();

include_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/utils/isAdmin.php';

switch ($method | $uri) {
    case ($method == 'POST' && $uri == '/api/v1/user/register'):
        require __DIR__ . '/api/v1/user/register.php';
        break;
    case ($method == 'POST' && $uri == '/api/v1/user/login'):
        require __DIR__ . '/api/v1/user/login.php';
        break;
    case ($method == 'GET' && $uri == '/api/v1/user/getUsers'):
        require __DIR__ . '/api/v1/user/getUsers.php';
        break;
    case ($method == 'POST' && $uri == '/api/v1/user/deleteUser'):
        require __DIR__ . '/api/v1/user/deleteUser.php';
        break;
    case ($method == 'GET' && $uri == '/api/v1/movie/search'):
        require __DIR__ . '/api/v1/movie/search.php';
        break;
    case ($method == 'GET' && $uri == '/api/v1/movie/display'):
        require __DIR__ . '/api/v1/movie/display.php';
        break;
    case ($method == 'GET' && $uri == '/api/v1/movie/getInfo'):
        require __DIR__ . '/api/v1/movie/getInfo.php';
        break;
    case ($method == 'POST' && $uri == '/api/v1/movie/update'):
        require __DIR__ . '/api/v1/movie/update.php';
        break;
    case ($method == 'POST' && $uri == '/api/v1/movie/del'):
        require __DIR__ . '/api/v1/movie/del.php';
        break;        
    case ($method == 'POST' && $uri == '/api/v1/movie/add'):
        require __DIR__ . '/api/v1/movie/add.php';
        break;
    case ($method == 'GET' && $uri == '/api/v1/comment/getList'):
        require __DIR__ . '/api/v1/comment/getList.php';
        break;
    case ($method == 'POST' && $uri == '/api/v1/comment/add'):
        require __DIR__ . '/api/v1/comment/add.php';
        break;
    case ($method == 'DELETE' && $uri == '/api/v1/comment/del'):
        require __DIR__ . '/api/v1/comment/del.php';
        break;
    case ($method == 'PUT' && $uri == '/api/v1/comment/edit'):
        require __DIR__ . '/api/v1/comment/edit.php';
        break;
    default:
        echo 'API Running';
        break;
}
?>
