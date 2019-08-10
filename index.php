<?php
require_once __DIR__ . '/vendor/autoload.php';

$klein = new \Klein\Klein();

$klein->respond('GET', '/~60160272/note/addNote', function ($request, $response, $service) {
    $service->render('Views/addNote.php');
});

$klein->respond('GET', '/~60160272/note/getNote', function ($request, $response, $service) {
    $service->render('Views/getNote.php');
});

$klein->respond('POST', '/~60160272/note/insertNote', function ($request, $response, $service) {
    $service->render('Views/insertNote.php');
});

$klein->respond('POST', '/~60160272/note/viewNote', function ($request, $response, $service) {
    $service->render('Views/viewNote.php');
});

$klein->respond('POST', '/~60160272/note/checkPass', function ($request, $response, $service) {
    $service->render('Views/checkPass.php');
});

$klein->respond('GET', '/~60160272/note/', function ($request, $response, $service) {
    $service->render('Views/Home.php');
});




$klein->dispatch();