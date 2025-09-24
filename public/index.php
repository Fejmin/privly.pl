<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../app/models/Note.php';
require __DIR__ . '/../app/controllers/NoteController.php';

use App\Controllers\NoteController;

$config = require __DIR__ . '/../config/config.php';
$controller = new NoteController($config);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ======================
//   API ENDPOINTY
// ======================
if ($path === '/api/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->apiStore();
    exit;
}

if ($path === '/api/fetch' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->apiFetch();
    exit;
}

// ======================
//   WEB ENDPOINTY
// ======================

// Strona tworzenia notatki
if ($path === '/' || $path === '/index.php') {
    require __DIR__ . '/../app/views/home.php';
    exit;
}

// Polityka prywatności
if ($path === '/privacy-policy') {
    require __DIR__ . '/../app/views/privacy-policy.php';
    exit;
}

// Zapis nowej notatki
if ($path === '/note/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
    exit;
}

// ✅ NOWE: Potwierdzenie poprawnego wyświetlenia
if (preg_match('#^/note/([a-zA-Z0-9]+)/confirm$#', $path, $m) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->confirmView($m[1]);
    exit;
}

// Wyświetlenie / pobranie notatki
if (preg_match('#^/note/([a-zA-Z0-9]+)$#', $path, $m)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // AJAX – zwraca JSON z treścią (bez kasowania przy błędnym haśle)
        $controller->fetch($m[1]);
    } else {
        // GET – strona z przyciskiem „Podejrzyj notatkę”
        $controller->show($m[1]);
    }
    exit;
}

http_response_code(404);
require __DIR__ . '/../app/views/404.php';
exit;
