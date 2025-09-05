<?php
require_once __DIR__ . '/src/GameService.php';
require_once __DIR__ . '/src/UserService.php';
require_once __DIR__ . '/src/OwnedService.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

switch (true) {
    // Game endpoints
    case $uri === '/api/games/getAll' && $method === 'GET':
        echo json_encode(GameService::getAll());
        break;
    case $uri === '/api/games/getById' && $method === 'GET':
        $id = $_GET['id'] ?? '';
        $game = GameService::getById($id);
        if ($game) {
            echo json_encode($game);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Game not found']);
        }
        break;
    case $uri === '/api/games/add' && $method === 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        echo json_encode(GameService::add($data));
        break;
    case $uri === '/api/games/update' && $method === 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        $result = GameService::update($data);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Game not found']);
        }
        break;
    case $uri === '/api/games/delete' && $method === 'DELETE':
        $id = $_GET['id'] ?? '';
        $deleted = GameService::delete($id);
        if ($deleted) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Game not found']);
        }
        break;

    // User endpoints
    case $uri === '/api/users/getAll' && $method === 'GET':
        echo json_encode(UserService::getAll());
        break;
    case $uri === '/api/users/getById' && $method === 'GET':
        $id = $_GET['id'] ?? '';
        $user = UserService::getById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        break;
    case $uri === '/api/users/add' && $method === 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        echo json_encode(UserService::add($data));
        break;
    case $uri === '/api/users/update' && $method === 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        $result = UserService::update($data);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        break;
    case $uri === '/api/users/delete' && $method === 'DELETE':
        $id = $_GET['id'] ?? '';
        $deleted = UserService::delete($id);
        if ($deleted) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        break;

    // Owned endpoints
    case $uri === '/api/owneds/getAll' && $method === 'GET':
        echo json_encode(OwnedService::getAll());
        break;
    case $uri === '/api/owneds/getById' && $method === 'GET':
        $id = $_GET['id'] ?? '';
        $owned = OwnedService::getById($id);
        if ($owned) {
            echo json_encode($owned);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Owned not found']);
        }
        break;
    case $uri === '/api/owneds/getByUser' && $method === 'GET':
        $userId = $_GET['userId'] ?? '';
        echo json_encode(OwnedService::getByUser($userId));
        break;
    case $uri === '/api/owneds/add' && $method === 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        $owned = OwnedService::add($data);
        if ($owned) {
            echo json_encode($owned);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Owned already exists']);
        }
        break;
    case $uri === '/api/owneds/update' && $method === 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        $result = OwnedService::update($data);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Owned not found']);
        }
        break;
    case $uri === '/api/owneds/delete' && $method === 'DELETE':
        $id = $_GET['id'] ?? '';
        $deleted = OwnedService::delete($id);
        if ($deleted) {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Owned not found']);
        }
        break;
    case $uri === '/api/owneds/play1hour' && $method === 'PUT':
        $id = $_GET['id'] ?? '';
        $result = OwnedService::play1hour($id);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Owned not found']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Not found']);
        break;
}
