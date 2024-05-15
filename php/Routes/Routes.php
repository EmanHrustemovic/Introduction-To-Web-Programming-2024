<?php

$host = 'localhost';
$dbname = 'uefa_euro';
$username = 'root';
$password = 'g3c9h.,1?0';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

require_once '../php/CRUD operations/event_crud';

require_once '../php/CRUD operations/group_page_crud';

require_once '../php/CRUD operations/matches_page_crud';

require_once '../php/CRUD operations/news_page_crud_crud';

require_once '../php/CRUD operations/teams_page_crud';
?>